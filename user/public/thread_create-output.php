<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POSTデータを受け取る
    $th_name = $_POST['th_name'];
    $channel_id = $_POST['channel_id'];
    $tag_id = $_POST['tag_id'];
    $content = $_POST['thread_text'];

    try {
        // トランザクション開始
        $pdo->beginTransaction();

        // threadテーブルにデータを挿入
        $stmt = $pdo->prepare("INSERT INTO thread (thread_name, channel_id, tag_id, thread_text) VALUES (:thread_name, :channel_id, :tag_id, :thread_text)");
        $stmt->bindParam(':thread_name', $th_name);
        $stmt->bindParam(':channel_id', $channel_id);
        $stmt->bindParam(':tag_id', $tag_id);
        $stmt->bindParam(':thread_text', $content);
        $stmt->execute();

        // 挿入したスレッドのIDを取得
        $thread_id = $pdo->lastInsertId();

        // tag_mngテーブルにデータを挿入
        $stmt = $pdo->prepare("INSERT INTO tag_mng (thread_id, tag_id) VALUES (:thread_id, :tag_id)");
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->bindParam(':tag_id', $tag_id);
        $stmt->execute();

        // コミット
        $pdo->commit();

        // リダイレクト
        header("Location: thread_detail.php?thread_id=" . $thread_id);
        exit;

    } catch (PDOException $e) {
        // ロールバック
        $pdo->rollBack();
        echo "スレッドの作成中にエラーが発生しました: " . htmlspecialchars($e->getMessage());
    }
}
?>
