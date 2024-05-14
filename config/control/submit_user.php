<?php
require '../../config/db-connect.php';

$mail = $_POST['mail'];
$name = $_POST['name'];
$pass = $_POST['pass'];

$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (mail, name, pass) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('prepare() failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param('sss', $mail, $name, $hashed_pass);

if ($stmt->execute()) {
    echo "ユーザーが正常に登録されました。";
} else {
    echo "エラー: " . htmlspecialchars($stmt->error);
}

$stmt->close();

$conn->close();
?>
