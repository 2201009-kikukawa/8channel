<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'header.php';
require '../../config/db-connect.php';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>スレッド作成</title>
  <link rel="stylesheet" href="thread.css">
</head>
<body>
    <form action="thread_create-output.php" method="post">
        <div class="fs-1">スレッド作成</div>
        <div class="fs-3">スレッドの作成のためにはログインが必要です</div>
        <div class="fs-3">ログインは<a href="login.php">「ゲーマーの登竜門」</a>からどうぞ。</div>

        <!--スレッド名入力-->
        <div class="th_name">名前</div>
        <div class="th_name-box">
            <input type="text" name="th_name" required>
        </div>

        <!--ゲーム名選択-->
        <div class="game-name">ゲーム名</div>
        <div class="game-name-select">
            <select name="channel_id" required>
                <option value="">選択してください</option>
                <?php
                try {
                    // クエリ実行
                    $query = "SELECT channel_id, channel_name FROM channel";
                    $stmt = $pdo->query($query);

                    // 結果をチェック
                    if ($stmt->rowCount() > 0) {
                        // データをプルダウンメニューに追加
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . htmlspecialchars($row['channel_id']) . '">' . htmlspecialchars($row['channel_name']) . '</option>';
                        }
                    } else {
                        echo '<option value="">チャンネルが見つかりません</option>';
                    }
                } catch (PDOException $e) {
                    echo '<option value="">クエリの実行に失敗しました: ' . htmlspecialchars($e->getMessage()) . '</option>';
                }
                ?>
            </select>
        </div>

        <!--タグ選択-->
        <div class="tag">タグ</div>
        <div class="tag-select">
            <select name="tag_id" required>
                <option value="">選択してください</option>
                <?php
                try {
                    // クエリ実行
                    $query = "SELECT tag_id, tag_name FROM tag";
                    $stmt = $pdo->query($query);

                    // 結果をチェック
                    if ($stmt->rowCount() > 0) {
                        // データをプルダウンメニューに追加
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . htmlspecialchars($row['tag_id']) . '">' . htmlspecialchars($row['tag_name']) . '</option>';
                        }
                    } else {
                        echo '<option value="">タグが見つかりません</option>';
                    }
                } catch (PDOException $e) {
                    echo '<option value="">クエリの実行に失敗しました: ' . htmlspecialchars($e->getMessage()) . '</option>';
                }
                ?>
            </select>
        </div>

        <!--スレッド内容入力-->
        <!--時間があったら改行も指定できるようにしたい-->
        <div class="thread">内容</div>
        <div class="thread-box">
            <textarea name="thread_txt" cols="33" rows="3" placeholder="スレッド内容を入力してください(100文字以内)" required></textarea>
        </div>

        <button class="btn btn-outline-success" type="button" onclick="history.back()">戻る</button>
        <button type="submit" class="btn btn-outline-success" name="create"><span>スレッドを作成</span></button>
    </form>
</body>
</html>
