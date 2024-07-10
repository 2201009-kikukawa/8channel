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
        die('ログインをしてください。ログインは<a href="login.php">「ゲーマーの登竜門」</a>からどうぞ。');
    }

    try {
        // メッセージを挿入
        $stmt = $pdo->prepare("INSERT INTO message (message_txt, user_id, thread_id) VALUES (:message_txt, :user_id, :thread_id)");
        $stmt->bindParam(':message_txt', $message_txt);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->execute();

        // 直前の挿入IDを取得
        $last_insert_id = $pdo->lastInsertId();

        // メッセージの数を取得
        $stmt_count = $pdo->prepare("SELECT COUNT(*) as count FROM message WHERE thread_id = :thread_id");
        $stmt_count->bindParam(':thread_id', $thread_id);
        $stmt_count->execute();
        $message_count = $stmt_count->fetch(PDO::FETCH_ASSOC)['count'];

        // message_detail テーブルに挿入
        $stmt_detail = $pdo->prepare("INSERT INTO message_detail (message_id, message_cnt) VALUES (:message_id, :message_cnt)");
        $stmt_detail->bindParam(':message_id', $last_insert_id);
        $stmt_detail->bindParam(':message_cnt', $message_count);
        $stmt_detail->execute();

        header('Location: thread_detail.php?thread_id=' . $thread_id);
        exit();
    } catch (PDOException $e) {
        die("メッセージ投稿中にエラーが発生しました: " . htmlspecialchars($e->getMessage()));
    }
}
?>