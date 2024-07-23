<?php
include 'stop_check_output.php'; // ユーザー情報の取得
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stop_check.css">
    <title>アカウント停止確認</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <form method="post" action="stop_finish.php">
            <h2>アカウントを停止してもよろしいですか？</h2>
            <p class="ID"><strong>ユーザーID:&nbsp;&nbsp;&nbsp;</strong> <?php echo htmlspecialchars($user_id); ?></p>
            <p><strong>ユーザー名:&nbsp;&nbsp;&nbsp;</strong> <?php echo htmlspecialchars($userName); ?></p>
            <div class="stop">
            <label for="detail">停止理由を選択してください:&nbsp;&nbsp;&nbsp;</label>
            <select name="reason" id="detail">
                <option value="1">迷惑なコメント</option>
                <option value="2">暴力的なコメント</option>
                <option value="3">卑猥なコメント</option>
            </select>
            </div>

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
