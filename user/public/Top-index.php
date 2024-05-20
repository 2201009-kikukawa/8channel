<?php require './header.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8channel TOP</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .search-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .search-container input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
        }
        .search-container button {
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
        }
        .search-container button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div id="app" class="container mt-4">
        <h1>8ちゃんねる</h1>
        
        <div class="d-flex justify-content-around my-4">
            <a href="#" class="btn btn-primary">最新スレッド</a>
            <a href="#" class="btn btn-success">人気スレッド</a>
            <a href="#" class="btn btn-info">ゲーム一覧</a>
        </div>

        <!-- 検索バー -->
        <div class="search-container">
            <input type="text" v-model="searchQuery" placeholder="スレッドを検索">
            <button>
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div class="list-group">
            <a v-for="thread in filteredThreads" :key="thread.thread_id" :href="'thread.php?id=' + thread.thread_id" class="list-group-item list-group-item-action">
                <h5 class="mb-1">{{ thread.thread_name }}</h5>
                <small>投稿日: {{ thread.date }}</small>
            </a>
            <p v-if="filteredThreads.length === 0">スレッドが見つかりませんでした。</p>
        </div>
    </div>

    <script src="./src/top-vue.js"></script>
</body>
</html>
