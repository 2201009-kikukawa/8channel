<?php
// セッションの開始または再開
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト</title>
    <script>
        function redirectToPreviousPage() {
            // 前のページのURLにリダイレクト
            window.location.href = document.referrer || 'Top-index.php'; // referrerが空の場合のデフォルトURL
        }

        function handleLogout(){
            window.location.href = 'logout_output.php';
        }
    </script>
</head>
<body>
    <main>
        <h1>ログアウトしますか？</h1>
        <button onclick="handleLogout()">はい</button>
        <button onclick="redirectToPreviousPage()">いいえ</button>
    </main>
</body>
</html>
