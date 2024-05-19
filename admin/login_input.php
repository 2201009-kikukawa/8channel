<!DOCTYPE html>
<html>
<head>
    <title>ログイン</title>
</head>
<body>
    <h2>8ちゃんねる 管理者 ログイン</h2>
    <form method="POST" action="login_output.php">
        <label for="mail">mail:</label><br>
        <input type="text" id="mail" name="mail" required><br>
        <label for="password">パスワード:</label><br>
        <input type="password" id="password" name="password" required><br>
        <button type="submit" class="btn btn-primary">ログイン</button>
    </form>
</body>
</html>
