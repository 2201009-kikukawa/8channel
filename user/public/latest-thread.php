<?php require './header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>人気スレッド</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuejs-paginate@2.1.0"></script>
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
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }
        .pagination li {
            margin: 0 5px;
        }
        .pagination a {
            display: block;
            padding: 8px 16px;
            color: #007bff;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .pagination a:hover {
            background-color: #f0f0f0;
        }
        .pagination .active a {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
        }

        @media(min-width: 1024px){
            #side{
                display: flex;
            }
        }
    </style>
</head>
<body>
    <div id = "app">
    <div id = "side">
        <div class = "collapse" id = "navbarToggleExternalContent" data-bs-theme="dark">
            <div class="bg-dark p-4">
                <h5 class="text-body-emphasis h4">タグ一覧</h5>
                <span class="text-body-secondary">
                    <button v-for="tag in tags" :key="tag.tag_id" @click.prevent="filterThreadsByTag(tag.tag_id,tag.tag_name)" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">{{ tag.tag_name }}</h5>
                    </button>
                    <p v-if="tags.length === 0">タグが見つかりませんでした。</p>
                </span>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </div>
    
    <div class="container mt-4">
        <h3>{{tag_name}}最新スレッド一覧</h3>
        
        <div class="d-flex justify-content-around my-4">
            <a href="latest-thread.php" class="btn btn-primary">最新スレッド</a>
            <a href="popular-thread.php" class="btn btn-success">人気スレッド</a>
            <a href="Viewgame.php" class="btn btn-info">ゲーム一覧</a>
        </div>

        <!-- 検索バー -->
        <div class="search-container">
            <input type="text" v-model="searchQuery" placeholder="スレッドを検索">
            <button>
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div class="list-group">
            <a v-for="thread in paginatedThreads" :key="thread.thread_id" :href="'thread.php?id=' + thread.thread_id" class="list-group-item list-group-item-action">
                <h5 class="mb-1">{{ thread.thread_name }}</h5>
                <small>投稿日: {{ thread.date }}</small>
            </a>
            <p v-if="filteredThreads.length === 0">スレッドが見つかりませんでした。</p>
        </div>

        <!-- ページネーション -->
        <paginate
            v-if="pageCount > 1"
            :page-count="pageCount"
            :click-handler="goToPage"
            :prev-text="'前'"
            :next-text="'次'"
            :container-class="'pagination'"
            :page-class="'page-item'"
            :page-link-class="'page-link'"
            :prev-class="'page-item'"
            :next-class="'page-item'"
            :prev-link-class="'page-link'"
            :next-link-class="'page-link'"
        ></paginate>
    </div>
    </div>
    <script src="./src/latest-threads.js"></script>
</body>
</html>
