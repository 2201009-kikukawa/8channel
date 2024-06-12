<?php
require "header.php";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログイン</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <h1 class="login-title">8ちゃんねる 管理者 ログイン</h1>
    <div class="wave-container1">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="svg1">
            <path d="M0,40 C500,100 700,0 1200,80" fill="none" stroke="lime" stroke-width="2"/>
        </svg>
    </div>
    <form>
        <label for="email">mail:</label>
        <input type="email" id="email" name="email" placeholder="aaa@bbb.com">
        <br>
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password">
        <br>
        <button type="submit">ログイン</button>
    </form>
</body>
</html>
