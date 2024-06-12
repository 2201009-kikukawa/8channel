<?php
session_start();
ob_start(); // 出力バッファリングを開始

require '../../config/db-connect.php'; // db-connect.phpで$pdoが設定されていることを確認
require 'header.php';

// ログイン処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail']) && isset($_POST['password'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    try {
        // PDOを使用してクエリを準備
        $stmt = $pdo->prepare("SELECT * FROM admin_user WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) { // パスワードをプレーンテキストで比較
            // ログイン成功時の処理
            $_SESSION['mail'] = $mail;
            header('Location: ReportList.php'); // ログイン後のリダイレクト先
            exit();
        } else {
            $login_error = "ユーザー名またはパスワードが間違っています。";
            echo $login_error;
        }
    } catch (PDOException $e) {
        echo 'データベースエラー: ' . $e->getMessage();
    }
}

ob_end_flush(); // 出力バッファリングを終了し、バッファの内容を出力
?>
