<?php
session_start();
ob_start(); // Start output buffering

if (isset($_SESSION['User']['id'])) {
    unset($_SESSION['User']['id']);
    session_regenerate_id(true); // 新しいセッションIDを発行する
    // 他に必要なログアウト処理があれば追加する
}

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


        if ($user !== false && $password == $user['password']) {
            // ログイン成功の処理
            $_SESSION['mail'] = $mail;

            // ユーザーのセッションを破棄する
            unset($_SESSION['User']['id']); // ユーザーのIDに応じて適切に変更する

            // 現在のセッションを破棄して新しいセッションIDを発行する
            session_regenerate_id(true);

            header('Location: ReportList.php');
            exit();
        } else {
            $_SESSION['error'] = 'ログインに失敗しました。メールアドレスまたはパスワードが正しくありません。';
            header('Location: login_input.php');
            exit();
        }
    } catch (PDOException $e) {
        echo 'データベースエラー: ' . $e->getMessage();
    }
}
