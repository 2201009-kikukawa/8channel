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
        th, td {
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
    <?php include 'header.php'; ?>
    <?php include 'message_output.php'; ?>
    <main>
        <h2>
            <u>ID：<?php echo htmlspecialchars($messages[0]['user_name'], ENT_QUOTES, 'UTF-8'); ?>の投稿一覧</u>
        </h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">日付</th>
                    <th scope="col">メッセージ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?php echo htmlspecialchars($message['data'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($message['message_txt'], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button onclick="stopFunction()">停止</button>
        <button onclick="goBack()">戻る</button>
    </main>
    <script>
        function stopFunction() {
            // 実際の停止機能をここに実装します
            alert("停止しました。");
        }

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
