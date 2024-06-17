<?php
require '../../config/db-connect.php';


// データベースからユーザーのメッセージを取得
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

$stmt = $pdo->prepare('SELECT user_name, data, message_txt FROM message INNER JOIN user ON message.user_id = user.user_id WHERE message.user_id = :user_id');
$stmt->execute(['user_id' => $user_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($messages)) {
    echo '<p>ユーザーID: ' . htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') . ' のメッセージが見つかりません。</p>';
    exit;
}
?>

<h2>
    <u>ID：<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?>の投稿一覧</u>
</h2>
<table class="table table-bordered">
    <thead>
        <tr class="heager-message">
            <th scope="col" class="date-colum">日付</th>
            <th scope="col">メッセージ</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $message): ?>
        <tr class="message-row">
            <td><?php echo htmlspecialchars($message['data'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($message['message_txt'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>