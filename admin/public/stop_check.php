<?php
include 'stop_check_output.php'; // ユーザー情報の取得
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント停止確認</title>
    <style>
        /* スタイルはそのまま */
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <form method="post" action="stop_finish.php">
            <h1>アカウントを停止してもよろしいですか？</h1>
            <p><strong>ユーザーID:</strong> <?php echo htmlspecialchars($user_id); ?></p>
            <p><strong>ユーザー名:</strong> <?php echo htmlspecialchars($userName); ?></p>
            <label for="detail">停止理由を選択してください</label>
            <select name="reason" id="detail">
                <option value="1">理由1</option>
                <option value="2">理由2</option>
                <option value="3">理由3</option>
            </select>

            <div class="button-container">
                <button type="submit" class="button-yes">はい</button>
                <button type="button" class="button-no" onclick="cancelStop()">いいえ</button>
            </div>
            <!-- hidden fields to pass user_id and userName -->
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <input type="hidden" name="userName" value="<?php echo htmlspecialchars($userName); ?>">
        </form>
    </main>
    <script>
        function cancelStop() {
            var userId = '<?php echo htmlspecialchars($user_id); ?>';
            window.location.href = 'message.php?user_id=' + userId;
        }
    </script>
</body>
</html>
