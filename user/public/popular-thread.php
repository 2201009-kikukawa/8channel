<?php require './header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>人気スレッド</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuejs-paginate@2.1.0"></script>
    <link rel="stylesheet" href="./css/popular-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div id = "app">
        <div id="side">
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
            <div class="collapse" id="navbarToggleExternalContent" data-bs-theme="dark">
                <div class="bg-dark p-4">
                    <h5 class="text-body-emphasis h4">タグ一覧</h5>
                    <div class="tag-container">
                        <button v-for="tag in tags" :key="tag.tag_id" @click.prevent="filterThreadsByTag(tag.tag_id, tag.tag_name)" class="tag-button">
                            <p class="mb-1">{{ tag.tag_name }}</p>
                        </button>
                        <p v-if="tags.length === 0">タグが見つかりませんでした。</p>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container mt-4">
            <div class="title">
                <p class="title-text">{{tag_name}}人気スレッド一覧</p>
                <a href="thread_create.php" id="title-btn" class="btn btn-primary">スレッド作成</a>
            </div>
            <div class="button-group">
                <a href="latest-thread.php" class="btn btn-primary" id="btns">最新スレッド</a>
                <a href="popular-thread.php" class="btn btn-success" id="btns">人気スレッド</a>
                <a href="Viewgame.php" class="btn btn-info" id="btns">ゲーム一覧</a>
            </div>

        <!-- 検索バー -->
        <div class="search-container">
            <input type="text" v-model="searchQuery" placeholder="スレッドを検索">
            <button>
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div class="list-group">
            <a v-for="thread in paginatedThreads" :key="thread.thread_id" :href="'thread_detail.php?thread_id=' + thread.thread_id" class="list-group-item list-group-item-action">
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
    <script src="./src/popular-threads.js"></script>
</body>
</html>
