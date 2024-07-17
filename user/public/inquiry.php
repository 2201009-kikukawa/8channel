<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../../config/db-connect.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>スレッド作成</title>
  <link rel="stylesheet" href="./css/inquiry.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="inquiry-box">
    <h2>お問い合わせフォーム</h2>
        <form action="send_email.php" method="post">
            
            <label for="email">メールアドレス:</label><br>
            <input type="email" id="email" name="email" required><br><br>


            <input type="submit" value="送信">
        </form>
    </div>
</body>
</html>