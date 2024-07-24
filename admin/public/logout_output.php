<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/logout.css">
    <title>ログアウト結果</title>
</head>
<body>
    <main>
    <?php

    // セッションが破棄されたことを確認する
    if (!isset($_SESSION['user_id'])) {
        echo "<p>ログアウトが正常に行われました。</p>";
        echo "<p class='x'>トップページに戻ります</p>";
    } else {
        echo "<p>ログアウトに失敗しました。</p>";
    }
    ?>
    <script>
        setTimeout(function(){
            window.location.href = '../../user/public/Top-index.php'; // ログイン画面のURLにリダイレクト
        }, 2000); // 2秒後にリダイレクト
    </script>
</body>
</html>
