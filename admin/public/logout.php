<?php
// セッションの開始または再開
session_start();

// セッションの終了
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト</title>
    <script>
        function redirectToLogin() {
            window.location.href = 'logout_output.php'; // ログイン画面のURLにリダイレクト
        }

        function redirectToReportList() {
            window.location.href = 'ReportList.php'; // ReportList.php にリダイレクト
        }
    </script>
</head>
<body>
    <main>
        <h1>ログアウトしますか？</h1>
        <button onclick="handleLogout()">はい</button>
        <button onclick="redirectToReportList()">いいえ</button>
    </main>
    <script>
        function handleLogout() {
            // ログアウト処理は既にPHPで行われています
            redirectToLogin(); // ログイン画面にリダイレクト
        }
    </script>
</body>
</html>
