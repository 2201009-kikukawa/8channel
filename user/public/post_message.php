<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POSTデータを受け取る
    $message_txt = $_POST['message_txt'];
    $thread_id = intval($_POST['thread_id']);
    $user_id = isset($_SESSION['User']['id']) ? intval($_SESSION['User']['id']) : 0;

    if ($user_id === 0) {
        // ログインしていない場合のエラーをJavaScriptのアラートで表示
        echo "<script>alert('ログインをしてください。ログインは「ゲーマーの登竜門」からどうぞ。');</script>";
        echo "<script>window.history.back();</script>"; // 前のページに戻る
        exit();
    }

    $image_path = null;
    // 画像ファイルの処理
    if (isset($_FILES['message_image']) && $_FILES['message_image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['message_image'];
        $image_ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

        // 拡張子をチェック
        if (in_array($image_ext, $allowed_exts)) {
            $image_name = uniqid() . '_' . basename($image['name']);
            $upload_dir = './uploads/';
            $upload_file = $upload_dir . $image_name;

            // 画像を指定されたディレクトリに移動
            if (move_uploaded_file($image['tmp_name'], $upload_file)) {
                $image_path = $upload_file;
            } else {
                echo "<script>alert('画像のアップロードに失敗しました。');</script>";
                echo "<script>window.history.back();</script>"; // 前のページに戻る
                exit();
            }
        } else {
            echo "<script>alert('許可されていない画像形式です。jpg, jpeg, png, gif のみアップロード可能です。');</script>";
            echo "<script>window.history.back();</script>"; // 前のページに戻る
            exit();
        }
    }

    try {
        // メッセージを挿入
        $stmt = $pdo->prepare("INSERT INTO message (message_txt, user_id, thread_id, image_path) VALUES (:message_txt, :user_id, :thread_id, :image_path)");
        $stmt->bindParam(':message_txt', $message_txt);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->bindParam(':image_path', $image_path);
        $stmt->execute();

        // 直前の挿入IDを取得
        $last_insert_id = $pdo->lastInsertId();

        // メッセージの数を取得
        $stmt_count = $pdo->prepare("SELECT COUNT(*) as count FROM message WHERE thread_id = :thread_id");
        $stmt_count->bindParam(':thread_id', $thread_id);
        $stmt_count->execute();
        $message_count = $stmt_count->fetch(PDO::FETCH_ASSOC)['count'];


        $stmt_detail = $pdo->prepare("INSERT INTO message_detail (message_id, message_cnt) VALUES (:message_id, :message_cnt)");
        $stmt_detail->bindParam(':message_id', $last_insert_id);
        $stmt_detail->bindParam(':message_cnt', $message_count);
        $stmt_detail->execute();
        echo "<script>alert('メッセージの投稿が成功しました。');</script>";
        echo "<script>window.location.href = 'thread_detail.php?thread_id=" . $thread_id . "';</script>";
        exit();
    } catch (PDOException $e) {
        echo "<script>alert('メッセージ投稿中にエラーが発生しました: " . htmlspecialchars($e->getMessage()) . "');</script>";
        echo "<script>window.history.back();</script>"; 
        exit();
    }
}
?>
