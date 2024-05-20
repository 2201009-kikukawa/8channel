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
$sql = 'SELECT message.user_id, message.data, message.message_txt, user.user_name 
        FROM message 
        LEFT JOIN user ON message.user_id = user.user_id';
try {
    $stmt = $pdo->query($sql);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("データ取得に失敗しました: " . $e->getMessage());
}
?>
