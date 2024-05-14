<?php
// データベースへの接続などの初期化が必要な場合はここで行う

// クライアントから送信された検索IDを取得
$search_id = $_GET['search_id'] ?? '';

// データベースからレポートを検索
if (!empty($search_id)) {
    $sql = $conn->prepare('SELECT * FROM Report WHERE user_id = ?');
    $sql->execute([$search_id]);
} else {
    $sql = $conn->query('SELECT * FROM Report');
}

// 検索結果をJSON形式で出力
header('Content-Type: application/json');
echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC));
