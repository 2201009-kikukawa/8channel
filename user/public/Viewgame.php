<?php require './header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8channel TOP</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuejs-paginate@2.1.0"></script>
    <link rel="stylesheet" href="./css/Viewgame-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <h1 class="title">ゲーム一覧</h1>
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
                <div class="card border-success mb-3">
                    <div class="card-body">
                        <h5 class="mb-1">
                        <a :href="'game-thread-View.php?id=' + channel.channel_id">{{ channel.channel_name }}</a>
                        </h5>
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
    <?php require 'footer.php'?>

<link rel="stylesheet" href="./css/footer.css">
</body>
</html>