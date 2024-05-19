<?php require './header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8channel TOP</title>
</head>
<body>
    <div class="container mt-4">
        <h1>8ちゃんねる</h1>
        
        <div class="d-flex justify-content-around my-4">
            <a href="#" class="btn btn-primary">最新スレッド</a>
            <a href="#" class="btn btn-success">人気スレッド</a>
            <a href="#" class="btn btn-info">ゲーム一覧</a>
        </div>

        <div class="list-group">
            <?php 
            require '../../config/control/get_thread.php';
            $response = getThreads($pdo);

            $threads = json_decode($response, true);
            if ($threads && is_array($threads)) {
                foreach ($threads as $thread) {
                    echo '<a href="thread.php?id=' . htmlspecialchars($thread['thread_id']) . '" class="list-group-item list-group-item-action">';
                    echo '<h5 class="mb-1">' . htmlspecialchars($thread['thread_name']) . '</h5>';
                    echo '<small>投稿日: ' . htmlspecialchars($thread['date']) . '</small>';
                    echo '</a>';
                }
            } else {
                echo '<p>スレッドが見つかりませんでした。</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
