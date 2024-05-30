<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POSTデータを受け取る
    $message_txt = $_POST['message_txt'];
    $thread_id = intval($_POST['thread_id']);
    $user_id = isset($_SESSION['User']['id']) ? intval($_SESSION['User']['id']) : 0;

    if ($user_id === 0) {
        die('Invalid user ID.');
    }

    try {
        // メッセージを挿入
        $stmt = $pdo->prepare("INSERT INTO message (message_txt, user_id, thread_id) VALUES (:message_txt, :user_id, :thread_id)");
        $stmt->bindParam(':message_txt', $message_txt);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->execute();

        header('Location: thread_detail.php?thread_id=' . $thread_id);
        exit();
    } catch (PDOException $e) {
        die("メッセージ投稿中にエラーが発生しました: " . htmlspecialchars($e->getMessage()));
    }
}
?>
