<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config/db-connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POSTデータを受け取る
    $th_name = $_POST['th_name'];
    $channel_id = $_POST['channel_id'];
    $tag_ids = $_POST['tag_id']; // これは配列です
    $content = $_POST['thread_txt'];
    $user_id = isset($_SESSION['User']['id']) ? intval($_SESSION['User']['id']) : 0;

    if ($user_id === 0) {
        die('ログインをしてください。ログインは<a href="login.php">「ゲーマーの登竜門」</a>からどうぞ。');
    }

    try {
        // スレッド名の重複をチェック
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM thread WHERE thread_name = :th_name");
        $stmt->bindParam(':th_name', $th_name);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // 重複がある場合はアラート表示してスレッド作成ページに戻る
            echo "<script>alert('このスレッド名はすでに使用されています。');</script>";
            echo '<script>window.location.href = "thread_create.php";</script>';
            exit;
        }

        // トランザクション開始
        $pdo->beginTransaction();

        // threadテーブルにデータを挿入
        // 最初のタグIDを使用
        $first_tag_id = $tag_ids[0];
        $stmt = $pdo->prepare("INSERT INTO thread (thread_name, channel_id, tag_id, thread_txt) VALUES (:thread_name, :channel_id, :tag_id, :thread_txt)");
        $stmt->bindParam(':thread_name', $th_name);
        $stmt->bindParam(':channel_id', $channel_id);
        $stmt->bindParam(':tag_id', $first_tag_id);
        $stmt->bindParam(':thread_txt', $content);
        $stmt->execute();

        // 挿入したスレッドのIDを取得
        $thread_id = $pdo->lastInsertId();

        // tag_mngテーブルにデータを挿入
        $stmt = $pdo->prepare("INSERT INTO tag_mng (thread_id, tag_id) VALUES (:thread_id, :tag_id)");
        foreach ($tag_ids as $tag_id) {
            $stmt->bindParam(':thread_id', $thread_id);
            $stmt->bindParam(':tag_id', $tag_id);
            $stmt->execute();
        }

        // コミット
        $pdo->commit();

        // リダイレクト
        header("Location: thread_detail.php?thread_id=" . $thread_id);
        exit;

    } catch (PDOException $e) {
        // ロールバック
        $pdo->rollBack();
        echo "スレッドの作成中にエラーが発生しました: " . htmlspecialchars($e->getMessage());
    }
}
?>
