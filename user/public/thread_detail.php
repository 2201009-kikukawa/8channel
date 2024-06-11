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
    $stmt = $pdo->prepare("SELECT thread_name,thread_txt FROM thread WHERE thread_id = :thread_id");
    $stmt->bindParam(':thread_id', $thread_id);
    $stmt->execute();
    $thread = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$thread) {
        die('スレッドが見つかりませんでした。');
    }

    // メッセージを取得（降順）
    $stmt = $pdo->prepare("
        SELECT m.message_id, m.message_txt, m.data, u.user_id, u.user_name, md.message_cnt
        FROM message m
        JOIN user u ON m.user_id = u.user_id
        JOIN message_detail md ON m.message_id = md.message_id
        WHERE m.thread_id = :thread_id
        ORDER BY m.data DESC
        LIMIT 10
    ");

    $stmt->bindParam(':thread_id', $thread_id);
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
    <link rel="stylesheet" href="./css/report_modal.css">
    <link rel="stylesheet" href="./css/sns_shere.css">
</head>
<body>
    <h1><?= htmlspecialchars($thread['thread_name']) ?></h1>
    <h3><?= nl2br(htmlspecialchars($thread['thread_txt'])) ?></h3>
    <?php if (empty($messages_asc)): ?>
        <p>このスレッドにはまだメッセージがありません。</p>
    <?php else: ?>
        <ul>
            <?php foreach ($messages_asc as $message): ?>
                <li class="message" data-message-id="<?= $message['message_id'] ?>" data-message-text="<?= htmlspecialchars($message['message_txt']) ?>">
                    <strong><?= $message['message_cnt'] ?></strong>
                    <strong><?= htmlspecialchars($message['user_name']) ?></strong>
                    <p><?= htmlspecialchars($message['message_txt']) ?></p>
                    <small><?= htmlspecialchars($message['data']) ?></small>
                    <button class="report-button" data-message-id="<?= $message['message_id'] ?>" data_user_name="<?= htmlspecialchars($message['user_name']) ?>" data_user_id="<?= htmlspecialchars($message['user_id']) ?>">報告</button>
                    <button class="share-button">共有</button>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h2>メッセージを投稿</h2>
    <form action="post_message.php" method="post">
        <textarea name="message_txt" rows="6" cols="50" required></textarea><br>
        <input type="hidden" name="thread_id" value="<?= $thread_id ?>">
        <input type="hidden" name="user_id" id="user_id" value="<?= isset($_SESSION['User']['id']) ? intval($_SESSION['User']['id']) : '' ?>">
        <button type="submit">投稿</button>
    </form>

    <!-- 報告モーダル -->
    <div id="report-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>このコメントを報告</h2>
            <!-- ユーザー名を表示する要素 -->
            <div id="reported-user-name"></div>
            <form id="report-form">
                <input type="hidden" id="report_user_id" name="report_user_id" value="">
                <label for="report_reason">報告理由:</label>
                <select name="report_reason" id="report-reason" required>
                    <option value="1">迷惑なコメント</option>
                    <option value="2">暴力的なコメント</option>
                    <option value="3">卑猥なコメント</option>
                </select><br>
                <button type="submit">報告する</button>
            </form>
        </div>
    </div>

    <input type="hidden" id="thread-id" value="<?= $_GET['thread_id'] ?>"> 
    <div id="sns-share-modal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="message-text"></p>
            <input type="text" id="share-link" readonly>
            <button id="copy-link">コピー</button>
            <div class="sns-icons">
             <a id="share-twitter" href="" target="_blank">
                <img src="./image/x-icon.png" alt="Twitter">
             </a>
             <a id="share-line" href="" target="_blank">
                <img src="./image/line-icon.png" alt="LINE">
             </a>
             <a id="share-discord" href="" target="_blank">
                <img src="./image/discord-icon.png" alt="Discord">
             </a>
            </div>
        </div>
    </div>

    <script src="./src/report_modal.js" defer></script>
    <script src="./src/sns_shere.js" defer></script>

</body>
</html>
