<?php
require '../../config/db-connect.php';
header('Content-Type: application/json');
$channelId = isset($_GET['channel_id']) ? $_GET['channel_id'] : null;

function getchannel($pdo, $channelId = null) {
    $response = [];
    try {
        if ($channelId !== null) {
            // channel_idが指定されている場合
            $stmt = $pdo->prepare("SELECT channel_id, channel_name FROM channel WHERE channel_id = :channelId");
            $stmt->bindValue(':channelId', $channelId, PDO::PARAM_INT);
            $stmt->execute();
            $channel = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($channel) {
                $response = [
                    'channel_id' => $channel['channel_id'],
                    'channel_name' => $channel['channel_name'],
                ];
            } else {
                $response['error'] = 'Channel not found';
            }
        } else {
            // channel_idが指定されていない場合は全てのチャンネルを取得
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
        }
    } catch (PDOException $e) {
        $response['error'] = $e->getMessage();
    }

    return json_encode($response);
}

echo getchannel($pdo, $channelId);
?>
