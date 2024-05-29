<?php
require '../../config/db-connect.php';
header('Content-Type: application/json');

function gettags($pdo) {
    $response = [];
    try {
        $stmt = $pdo->query("SELECT * FROM tag");
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($tags) {
            foreach ($tags as $tag) {
                $response[] = [
                    'tag_id' => $tag['tag_id'],
                    'tag_name' => $tag['tag_name'],
                ];
            }
        }
    } catch (PDOException $e) {
        $response['error'] = $e->getMessage();
    }

    return json_encode($response);
}

echo gettags($pdo);