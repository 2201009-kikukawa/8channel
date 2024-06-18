<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config/db-connect.php';

$response = ["success" => false, "message" => ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ログインユーザーのIDを取得
    $report_user_id = isset($_SESSION['User']['id']) ? $_SESSION['User']['id'] : null;
    
    if (!$report_user_id) {
        $response["message"] = "報告をするには、ログインが必要です";
        echo json_encode($response);
        exit;
    }

    $reported_user_id = intval($_POST['report_user_id']);  // 報告されたユーザーのID
    $report_reason = intval($_POST['report_reason']);  // 報告理由

    try {
        $stmt = $pdo->prepare("INSERT INTO report (report_user, user_id, report_reason) VALUES (:report_user, :user_id, :report_reason)");
        $stmt->bindParam(':report_user', $reported_user_id);
        $stmt->bindParam(':user_id', $report_user_id);
        $stmt->bindParam(':report_reason', $report_reason);

        if ($stmt->execute()) {
            $response["success"] = true;
            $response["message"] = "報告が正常に送信されました。";
        } else {
            $response["message"] = "報告の送信中にエラーが発生しました。";
        }
    } catch (PDOException $e) {
        $response["message"] = "データベースエラー: " . htmlspecialchars($e->getMessage());
    }
} else {
    $response["message"] = "無効なリクエストです。";
}

echo json_encode($response);

?>
