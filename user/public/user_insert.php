<?php require './header.php' ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/footer.css">
    <title>ID入力フォーム</title>
</head>
<body>
<link rel="stylesheet" href="css/user_insert.css">
    <h1>8ちゃんねる ID 登録</h1>
    <form action="../../config/control/submit_user.php" method="post">
        <div>
            <label for="mail">メールアドレス:</label>
            <input type="email" id="mail" name="mail" required>
        </div>
        <div>
            <label for="name">ユーザー名:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="pass">パスワード:</label>
            <input type="password" id="pass" name="pass" required>
        </div>
        <div>
            <button type="submit">登録</button>
        </div>
    </form>
    <?php require 'footer.php'?>

<link rel="stylesheet" href="./css/footer.css">
</body>
<?php require 'footer.php'?>
</html>