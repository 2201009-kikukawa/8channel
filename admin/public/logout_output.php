<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト結果</title>
</head>
<body>
    <?php

    // セッションが破棄されたことを確認する
    if (!isset($_SESSION['user_id'])) {
        echo "<p>ログアウトが正常に行われました。</p>";
    } else {
        echo "<p>ログアウトに失敗しました。</p>";
    }
    ?>
    <p>ログイン画面に戻ります...</p>
    <script>
        setTimeout(function(){
            window.location.href = './login_input.php'; // ログイン画面のURLにリダイレクト
        }, 3000); // 3秒後にリダイレクト
    </script>
</body>
</html>
