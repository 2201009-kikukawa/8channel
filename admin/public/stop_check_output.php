<?php
// クエリパラメータからユーザーIDを取得
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// ユーザーIDがない場合はエラーメッセージを表示
if ($user_id == 0) {
    echo "ユーザーIDが指定されていません。";
    exit();
}

// データベース接続情報<?php
$rootDirectory = basename($_SERVER['DOCUMENT_ROOT']);
//xamppを利用したlocal環境を使う場合は自分のDB情報を入力
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
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage() . " - Server: " . $SERVER);
}

// データベースからユーザー名を取得
$sql = "SELECT user_name FROM user WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$userName = $stmt->fetchColumn();
$stmt->closeCursor();

if (!$userName) {
    $userName = '不明';
}
?>
