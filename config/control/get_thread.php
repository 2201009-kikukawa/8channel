<?php
require '../../config/db-connect.php';
header('Content-Type: application/json');

function getThreads($pdo) {
    $response = [];
    try {
        $stmt = $pdo->query("SELECT * FROM thread");
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

echo getThreads($pdo);
