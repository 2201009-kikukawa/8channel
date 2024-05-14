<?php
require '../../config/db-connect.php';

$mail = $_POST['mail'];
$name = $_POST['name'];
$pass = $_POST['pass'];

$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO user (mail, user_name, password) VALUES (:mail, :name, :pass)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':mail', $mail);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':pass', $hashed_pass);

try {
    if ($stmt->execute()) {
        $message = "ユーザーが正常に登録されました。";
    } else {
        $message = "エラーが発生しました。";
    }
} catch (PDOException $e) {
    $message = "エラー: " . $e->getMessage();
}

echo "<script type='text/javascript'>alert('$message'); window.location.href = '/8channel/user/public';</script>";
?>
