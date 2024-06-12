<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
    <link rel="stylesheet" href="css/message.css">
</head>
<body>
    <?php
        include 'header.php';
        // クエリパラメータからユーザーIDを取得
        $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
    ?>
    <main>
        <?php include 'message_output.php'; ?>
        <div class="button-container">
        <button onclick="stopFunction()">停止</button>
        <button onclick="goBack()">戻る</button>
        </div>
    </main>
    <script>
        function stopFunction() {
            // 実際の停止機能をここに実装します
            window.location.href = 'stop_check.php?user_id=<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?>';
        }

        function goBack() {
            window.location.href = 'ReportList.php';
        }
    </script>
</body>
</html>
