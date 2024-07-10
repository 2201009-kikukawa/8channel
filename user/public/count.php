<?php
require '../../config/db-connect.php';

if (!isset($_POST['thread_id'])) {
    die('Invalid thread ID.');
}

$thread_id = intval($_POST['thread_id']);

try {
    // ビューカウントを更新
    $stmt = $pdo->prepare("UPDATE thread SET views = views + 1 WHERE thread_id = :thread_id");
    $stmt->bindParam(':thread_id', $thread_id);
    $stmt->execute();
} catch (PDOException $e) {
    die("データベースエラー: " . htmlspecialchars($e->getMessage()));
}
?>
<?php require 'footer.php'?>

<link rel="stylesheet" href="./css/footer.css">