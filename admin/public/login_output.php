<?php
session_start();
ob_start(); // Start output buffering

require '../../config/db-connect.php'; // Ensure $pdo is set in db-connect.php

// Login processing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail']) && isset($_POST['password'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    try {
        // Prepare the query using PDO
        $stmt = $pdo->prepare("SELECT * FROM admin_user WHERE mail = ?");
        $stmt->execute([$mail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if (isset($user) && $password == $user['password']) { // Compare passwords (plain text, insecure)
            // Process on successful login
            $_SESSION['mail'] = $mail;
            header('Location: ReportList.php'); // Redirect after login
            exit();
        } else {
            $login_error = "ユーザー名またはパスワードが間違っています。";
            echo $login_error;
        }
    } catch (PDOException $e) {
        echo 'データベースエラー: ' . $e->getMessage();
    }
}
?>

<form method="post" action="">
    <label for="mail">メールアドレス:</label>
    <input type="email" name="mail" id="mail" required>
    <br>
    <label for="password">パスワード:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">ログイン</button>
</form>
