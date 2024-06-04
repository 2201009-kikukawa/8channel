<?php require './header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8channel TOP</title>
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
    </style>
</head>
<body>
    <div id="app" class="container mt-4">

        <!-- 検索バー -->
        <div class="search-container">
            <input type="text" v-model="searchQuery" placeholder="ゲームを検索">
            <button>
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!--ゲーム一覧-->
        <div class="row">
            <div v-for="channel in paginatedChannels" :key="channel.channel_id" class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="mb-1">{{ channel.channel_name }}</h5>
                    </div>
                </div>
            </div>
            <p v-if="filteredChannels.length === 0" class="col-12">ゲームが見つかりませんでした。</p>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="./src/view-game.js"></script>
</body>
</html>