<?php
$rootDirectory = basename($_SERVER['DOCUMENT_ROOT']);
// xamppを利用したlocal環境を使う場合は自分のDB情報を入力
$SERVER = '127.0.0.1';
$DBNAME = '8channel';
$USER = 'eiki';
$PASS = 'Pass0103';

if ($rootDirectory != 'htdocs') {
    $SERVER = "mysql304.phy.lolipop.lan";
    $USER = "LAA1516915";
    $PASS = "Pass1111";
    $DBNAME = "LAA1516915-8cannel"; 
}

$conn = 'mysql:host=' . $SERVER . ';dbname=' . $DBNAME . ';charset=utf8';
try {
    $pdo = new PDO($conn, $USER, $PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続に失敗しました: " . $e->getMessage());
}

// メッセージを取得するSQLクエリ 

// データベースからユーザーのメッセージを取得
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

$stmt = $pdo->prepare('SELECT user.user_name, message.data, message.message_txt FROM message INNER JOIN user ON message.user_id = user.user_id WHERE message.user_id = :user_id');
$stmt->execute(['user_id' => $user_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($messages)) {
    echo '<p>ユーザーID: ' . htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') . ' のメッセージが見つかりません。</p>';
    exit;
}
?>

<h2>
    <u>ID：<?php echo htmlspecialchars($messages[0]['user_name'], ENT_QUOTES, 'UTF-8'); ?>の投稿一覧</u>
</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">日付</th>
            <th scope="col">メッセージ</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $message): ?>
        <tr>
            <td><?php echo htmlspecialchars($message['data'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($message['message_txt'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>