<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './header.php';
require '../../config/db-connect.php';

$thread_id = isset($_GET['thread_id']) ? intval($_GET['thread_id']) : 0;

if ($thread_id === 0) {
    die('Invalid thread ID.');
}

try {
    // ビューカウントを更新する
    $stmt = $pdo->prepare("UPDATE thread SET views = views + 1 WHERE thread_id = :thread_id");
    $stmt->bindParam(':thread_id', $thread_id);
    $stmt->execute();

    // スレッド名を取得
    $stmt = $pdo->prepare("SELECT thread_name FROM thread WHERE thread_id = :thread_id");
    $stmt->bindParam(':thread_id', $thread_id);
    $stmt->execute();
    $thread = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$thread) {
        die('スレッドが見つかりませんでした。');
    }

    // メッセージを取得
    $stmt = $pdo->prepare("
        SELECT m.message_txt, m.data, u.user_name 
        FROM message m
        JOIN user u ON m.user_id = u.user_id
        WHERE m.thread_id = :thread_id
        ORDER BY m.data ASC
        LIMIT 10
    ");
    $stmt->bindParam(':thread_id', $thread_id);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // メッセージのカウントを取得
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as count 
        FROM message 
        WHERE thread_id = :thread_id
    ");
    $stmt->bindParam(':thread_id', $thread_id);
    $stmt->execute();
    $message_count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
} catch (PDOException $e) {
    die("データベースエラー: " . htmlspecialchars($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スレッド詳細</title>
</head>
<body>
    <h1><?= htmlspecialchars($thread['thread_name']) ?></h1>

    <?php if (empty($messages)): ?>
        <p>このスレッドにはまだメッセージがありません。</p>
    <?php else: ?>
        <ul>
            <?php foreach ($messages as $index => $message): ?>
                <li>
                    <?= $message_count - $index ?>
                    <strong><?= htmlspecialchars($message['user_name']) ?>:</strong>
                    <p><?= htmlspecialchars($message['message_txt']) ?></p>
                    <small><?= htmlspecialchars($message['data']) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h2>メッセージを投稿</h2>
    <form action="post_message.php" method="post">
        <textarea name="message_txt" rows="6" cols="50" required></textarea><br>
        <input type="hidden" name="thread_id" value="<?= $thread_id ?>">
        <input type="hidden" name="user_id" value="<?= isset($_SESSION['User']['id']) ? intval($_SESSION['User']['id']) : '' ?>">
        <button type="submit">投稿</button>
    </form>
</body>
</html>
