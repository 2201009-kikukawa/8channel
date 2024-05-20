<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>8ちゃんねるログイン</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <form name="loginForm" action="login-output.php" method="post" onsubmit="return validateForm()">
    <div class="fs-1">8ちゃんねるログイン</div>
    <div>
      <input type="email" placeholder="メールアドレス" name="mail" required><br>
      <input type="password" placeholder="パスワード" name="pass" required>
    </div>
    <button type="submit" class="btn btn-outline-success" name="login"><span>ログイン</span></button>
  </form>
  <div class="newlogin-confirmation">
    <a href="user_insert.php">8ちゃんねる ID 作成</a>
  </div>
  <?php
  // エラーメッセージの表示
  if (isset($_GET['error'])) {
      echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
  }
  ?>
</body>
<script src="login.js"></script>
</html>
