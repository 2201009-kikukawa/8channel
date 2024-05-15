<?php require 'header.php' ;?>
<head>
  <link rel="stylesheet" href="">
</head>
<body>
  <form action="login-output.php" method="post">
    <div class="fs-1">8ちゃんねるログイン</div>
    <div>
      <input type="text" placeholder="メールアドレス" name="mail"><br>
      <input type="text" placeholder="パスワード" name="pass">
    </div>
    <button type="aubmit" class="btn btn-outline-success" name="login">ログイン</button>
  </form>
  <div class="newlogin-confirmation">
    <a href="newUser.php">8ちゃんねる ID 作成>
  </div>
</body>
</html>