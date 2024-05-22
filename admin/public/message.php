<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        main {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #000;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
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
            var userId = <?php echo $user_id; ?>;
            window.location.href = 'stop_check.php?user_id=' + userId;
        }


        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>