<?php

    require '../../config/db-connect.php';
    require 'header.php';

    // ユーザーIDが送信されたかを確認
    if(isset($_POST['id'])) {
        // ユーザーIDを取得
        $user_id = $_POST['id'];

        // ユーザーの情報を取得するクエリを準備
        $sql = $pdo->prepare('SELECT su.user_id, u.user_name, su.stop_reason 
                              FROM Stop_user su 
                              JOIN User u ON su.user_id = u.user_id 
                              WHERE su.user_id = ?');
        // ユーザーIDをバインドしてクエリを実行
        $sql->execute([$user_id]);
        // 結果を取得
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        // ユーザーが存在しない場合はエラーメッセージを表示して終了
        if (!$user) {
            echo "Error: 指定されたユーザーが見つかりませんでした。";
            exit;
        }

        // ユーザーのアカウントフラグを更新するクエリを準備
        $sql_update = $pdo->prepare('UPDATE User SET account_flag = 0 WHERE user_id = ?');
        // ユーザーのアカウントフラグを0に更新
        $sql_update->execute([$user_id]);

        // Stop_userからユーザーを削除するクエリを準備
        $sql_delete = $pdo->prepare('DELETE FROM Stop_user WHERE user_id = ?');
        // ユーザーを削除
        $sql_delete->execute([$user_id]);
    } else {
        // ユーザーIDが送信されていない場合、エラーを表示
        echo "Error: ユーザーIDが指定されていません。";
        exit; // スクリプトの実行を終了
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント解除完了</title>
</head>
<body>
    <h2>アカウントの停止を解除しました</h2>
    <p>ユーザーID: <?php echo $user['user_id']; ?></p>
    <p>ユーザー名: <?php echo $user['user_name']; ?></p>
    <p>停止理由: <?php echo $user['stop_reason']; ?></p>
    <?php
        echo '<form action="StopUser.php">';
            echo '<button type="submit">停止アカウント一覧へ</button>';
        echo '</form>';
    ?>
</body>
</html>