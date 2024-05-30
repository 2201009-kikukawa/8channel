<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './header.php';
require '../../config/db-connect.php';

// URLパラメータからスレッドIDを取得
$thread_id = isset($_GET['thread_id']) ? intval($_GET['thread_id']) : 0;

// limitパラメータの取得、デフォルトは10
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

// スレッドIDが無効な場合、エラーメッセージを表示して終了
if ($thread_id === 0) {
    die('無効なスレッドIDです。');
}

try {
    // ビューカウントを更新
    $stmt = $pdo->prepare("UPDATE thread SET views = views + 1 WHERE thread_id = :thread_id");
    $stmt->bindParam(':thread_id', $thread_id);
    $stmt->execute();

    // スレッド名を取得
    $stmt = $pdo->prepare("SELECT thread_name FROM thread WHERE thread_id = :thread_id");
    $stmt->bindParam(':thread_id', $thread_id);
    $stmt->execute();
    $thread = $stmt->fetch(PDO::FETCH_ASSOC);

    // スレッドが存在しない場合、エラーメッセージを表示して終了
    if (!$thread) {
        die('スレッドが見つかりませんでした。');
    }

    // メッセージを取得（降順）
    $sql = "
        SELECT m.message_id, m.message_txt, m.data, u.user_name, md.message_cnt
        FROM message m
        JOIN user u ON m.user_id = u.user_id
        JOIN message_detail md ON m.message_id = md.message_id
        WHERE m.thread_id = :thread_id
        ORDER BY m.data DESC
    ";
    if ($limit > 0) {
        $sql .= " LIMIT :limit";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':thread_id', $thread_id);
    if ($limit > 0) {
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    }
    $stmt->execute();
    $messages_desc = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // メッセージを昇順に並べ替える
    $messages_asc = array_reverse($messages_desc);

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

    <?php if (empty($messages_asc)): ?>
        <p>このスレッドにはまだメッセージがありません。</p>
    <?php else: ?>
        <ul>
            <?php foreach ($messages_asc as $message): ?>
                <li>
                    <strong><?= htmlspecialchars($message['message_cnt']) ?></strong>
                    <strong><?= htmlspecialchars($message['user_name']) ?></strong>
                    <p><?= htmlspecialchars($message['message_txt']) ?></p>
                    <small><?= htmlspecialchars($message['data']) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php if ($limit > 0): ?>
            <a href="?thread_id=<?= $thread_id ?>&limit=0">すべて表示</a>
        <?php else: ?>
            <a href="?thread_id=<?= $thread_id ?>&limit=10">最新10件を表示</a>
        <?php endif; ?>
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
