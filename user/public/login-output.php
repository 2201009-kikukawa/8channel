<?php
session_start();
require '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = $pdo->prepare('SELECT * FROM user WHERE mail = ?');
    $sql->execute([$_POST['mail']]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($_POST['pass'], $user['password'])) {
        if ($user['account_flag'] == 0) { // アカウントが有効な場合
            $_SESSION['User'] = [
                'id' => $user['user_id'],
                'mail' => $user['mail'],
                'name' => $user['user_name']
            ];
            header('Location: Top-index.php');
            exit();
        } else { // アカウントが無効な場合
            $error = 'アカウントが無効です。管理者にお問い合わせください。';
            header('Location: login.php?error=' . urlencode($error));
            exit();
        }
    } else {
        $error = 'ログインに失敗しました。メールアドレスまたはパスワードが正しくありません。';
        header('Location: login.php?error=' . urlencode($error));
        exit();
    }
} else {
    $error = '無効なリクエストです。';
    header('Location: login.php?error=' . urlencode($error));
    exit();
}
?>

