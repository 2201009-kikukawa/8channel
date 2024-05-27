<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        main {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #000;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            margin-right: 10px;
        }
        button:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <?php
        include 'header.php';
        // クエリパラメータからユーザーIDを取得
        $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
    ?>
    <main>
        <?php include 'message_output.php'; ?>
        <button onclick="stopFunction()">停止</button>
        <button onclick="goBack()">戻る</button>
    </main>
    <script>
        function stopFunction() {
            // 実際の停止機能をここに実装します
            window.location.href = 'stop_check.php?user_id=<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?>';
        }

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
