<?php
    // UserLift_input.php

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
    //} else {
        // ユーザーIDが送信されていない場合、エラーを表示
    //    echo "Error: ユーザーIDが指定されていません。";
    //    exit; // スクリプトの実行を終了
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー情報</title>
</head>
<body>
    <h2>このアカウントを解除してもよろしいですか？</h2>
    <p>ユーザーID: <?php echo $user['user_id']; ?></p>
    <p>ユーザー名: <?php echo $user['user_name']; ?></p>
    <p>停止理由: <?php echo $user['stop_reason']; ?></p>
    <?php
        echo '<form action="UserLift_output.php" method="post">';
            echo '<input type="hidden" name="id" value="', $row['user_id'], '">';
            echo '<button type="submit">はい</button>';
        echo '</form>';
        echo '<form action="StopUser.php">';
            echo '<button type="submit">いいえ</button>';
        echo '</form>';
    ?>
</body>
</html>