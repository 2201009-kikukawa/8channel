<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント停止確認</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        main {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
        }

        .button-yes,
        .button-no {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
            border-radius: 5px;
            border: none;
            color: #fff;
        }

        .button-yes {
            background-color: #4caf50;
        }

        .button-no {
            background-color: #f44336;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <?php include 'stop_check_output.php';?>
    <main>
        <h1>アカウントを停止してもよろしいですか？</h1>
        <p><strong>ユーザーID:</strong> <?php echo htmlspecialchars($user_id); ?></p>
        <p><strong>ユーザー名:</strong> <?php echo htmlspecialchars($userName); ?></p>
        <label for="detail">停止理由を選択してください</label>
        <select name="detail" id="detail">
            <option value="1">理由1</option>
            <option value="2">理由2</option>
            <option value="3">理由3</option>
        </select>

        <div class="button-container">
            <button type="button" class="button-yes" onclick="confirmStop()">はい</button>
            <button type="button" class="button-no" onclick="cancelStop()">いいえ</button>
        </div>
    </main>
    <script>
        function cancelStop() {
            // 「いいえ」ボタンがクリックされたときに、message.php にリダイレクトする
            var userId = <?php echo $user_id; ?>;
            window.location.href = 'message.php?user_id=' + userId;
        }
    </script>
</body>

</html>
