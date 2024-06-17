<?php
include '../../config/db-connect.php';

$conn = null; // $conn を初期化

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = htmlspecialchars($_POST['user_id']);
    $userName = htmlspecialchars($_POST['userName']);
    $reason_code = htmlspecialchars($_POST['reason']);

    // 停止理由のマッピング
    $reasons = [
        '1' => '理由1',
        '2' => '理由2',
        '3' => '理由3'
    ];

    $stop_reason = isset($reasons[$reason_code]) ? $reasons[$reason_code] : '理由不明';

    try {
        // データベース接続
        $conn = new PDO("mysql:host=$SERVER;dbname=$DBNAME;charset=utf8", $USER, $PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // user_idが既に存在するか確認
        $stmt = $conn->prepare("SELECT COUNT(*) FROM stop_user WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $userExists = $stmt->fetchColumn();

        if ($userExists) {
            $message = "このユーザーIDは既に登録されています。";
        } else {
            //account_flagを1に
            $stmt = $conn->prepare("UPDATE user SET account_flag = 1 WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            // SQL文を準備
            $stmt = $conn->prepare("INSERT INTO stop_user (user_id, stop_reason) VALUES (:user_id, :stop_reason)");
            // 値をバインド
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':stop_reason', $stop_reason);
            // SQL実行
            $stmt->execute();

            $stmt = $conn->prepare("DELETE FROM report WHERE report_user = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            $message = "アカウントが正常に停止されました。";
        }
    } catch (PDOException $e) {
        $message = "エラー: " . $e->getMessage();
    }

    $conn = null;
} else {
    $message = "不正なリクエストです。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stop_finish.css">
    <title>アカウント停止完了画面</title>
</head>
<body>
    <main>
        <h1><?php echo $message; ?></h1>
        <p class="ID"><strong>ユーザーID:</strong> <?php echo htmlspecialchars($user_id); ?></p>
        <p><strong>ユーザー名:</strong> <?php echo htmlspecialchars($userName); ?></p>
        <p><strong>停止理由:</strong> <?php echo htmlspecialchars($stop_reason); ?></p>
        <form action="ReportList.php" method="get">
            <button type="submit">報告一覧に戻る</button>
        </form>
    </main>
</body>
</html>
