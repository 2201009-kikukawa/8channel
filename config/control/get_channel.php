<?php
require '../../config/db-connect.php';
header('Content-Type: application/json');

function getchannel($pdo) {
    $response = [];
    try {
        $stmt = $pdo->query("SELECT * FROM channel");
        $channels = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($channels) {
            foreach ($channels as $channel) {
                $response[] = [
                    'channel_id' => $channel['channel_id'],
                    'channel_name' => $channel['channel_name'],
                ];
            }
        }
    } catch (PDOException $e) {
        $response['error'] = $e->getMessage();
    }

    return json_encode($response);
}

echo getchannel($pdo);