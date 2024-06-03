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
        $stmt = $conn->prepare("SELECT COUNT(*) FROM Stop_user WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $userExists = $stmt->fetchColumn();

        if ($userExists) {
            $message = "このユーザーIDは既に登録されています。";
        } else {
            //account_flagを1に
            $stmt = $conn->prepare("UPDATE User SET account_flag = 1 WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            // SQL文を準備
            $stmt = $conn->prepare("INSERT INTO Stop_user (user_id, stop_reason) VALUES (:user_id, :stop_reason)");
            // 値をバインド
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':stop_reason', $stop_reason);
            // SQL実行
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
    <title>アカウント停止完了画面</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        main {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            margin: 10px 0;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <main>
        <h1><?php echo $message; ?></h1>
        <p><strong>ユーザーID:</strong> <?php echo htmlspecialchars($user_id); ?></p>
        <p><strong>ユーザー名:</strong> <?php echo htmlspecialchars($userName); ?></p>
        <p><strong>停止理由:</strong> <?php echo htmlspecialchars($stop_reason); ?></p>
        <form action="ReportList.php" method="get">
            <button type="submit">報告一覧に戻る</button>
        </form>
    </main>
</body>
</html>
