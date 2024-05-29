<?php
require '../../config/db-connect.php';
header('Content-Type: application/json');

$tagId = isset($_GET['tag_id']) ? $_GET['tag_id'] : null;
function getThreads($pdo, $tagId = null) {
    $response = [];
    try {
        if ($tagId !== null) {
            // tag_idが指定されている場合はtag_mngテーブルからスレッドを取得
            $stmt = $pdo->prepare("
                SELECT t.* 
                FROM thread t 
                JOIN tag_mng tm ON t.thread_id = tm.thread_id 
                WHERE tm.tag_id = :tagId
            ");
            $stmt->bindValue(':tagId', $tagId, PDO::PARAM_INT);
        } else {
            // tag_idが指定されていない場合は全てのスレッドを取得
            $stmt = $pdo->query("SELECT * FROM thread");
        }

        $stmt->execute();
        $threads = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($threads) {
            foreach ($threads as $thread) {
                $response[] = [
                    'thread_id' => $thread['thread_id'],
                    'thread_name' => $thread['thread_name'],
                    'channel_id' => $thread['channel_id'],
                    'views' => $thread['views'],
                    'tag_id' => $thread['tag_id'],
                    'date' => $thread['date'],
                    'thread_txt' => $thread['thread_txt']
                ];
            }
        }
    } catch (PDOException $e) {
        $response['error'] = $e->getMessage();
    }

    return json_encode($response);
}

echo getThreads($pdo, $tagId);
?>
