<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../../config/db-connect.php';

    $mail = $_POST['mail'];
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    // メールアドレスの存在チェック
    $checkSql = "SELECT * FROM user WHERE mail = :mail";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->bindParam(':mail', $mail);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        // メールアドレスが既に存在する場合
        echo "<script type='text/javascript'>alert('このメールアドレスは既に登録されています');</script>";
        echo "<script type='text/javascript'>window.location.href = '/8channel/user/public/login.php';</script>";
    } else {
        // メールアドレスが存在しない場合
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (mail, user_name, password) VALUES (:mail, :name, :pass)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':pass', $hashed_pass);

        try {
            if ($stmt->execute()) {
                $message = "ユーザーが正常に登録されました。";
                echo "<script type='text/javascript'>alert('$message'); window.location.href = '/8channel/user/public/login.php';</script>";
            } else {
                $message = "エラーが発生しました。";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        } catch (PDOException $e) {
            $message = "エラー: " . $e->getMessage();
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>
