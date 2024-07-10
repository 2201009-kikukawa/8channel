<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8channel</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/header_style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header class="bg-black p-3 header-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <a href="Top-index.php"><img src="./image/rogo.jpg" alt="Site Logo" style="height: 50px;"></a>
            </div>
            
            <div class="header-text">
                <h1 class="h1">8ちゃんねる</h1>
                <p class="mb-0 text-muted" style="color: white !important;">ゲーム専門の掲示板やけん、ゲームに関する話をしろよぉ～</p>
            </div>

            <div class="header-btn">
                <?php if (isset($_SESSION['User']['id'])) :?>
                    <a href="./logout.php" class="btn btn-outline-primary hedbtn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 3.5rem; --bs-btn-font-size: .95rem;">Logout</a>
                <?php else: ?>
                    <a href="./login.php" class="btn btn-primary hedbtn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 3.5rem; --bs-btn-font-size: .95rem;">Login</a>
                <?php endif; ?>
                <a href="../../admin/public/login_input.php" class="admin-link">Admin Login</a>
            </div>
        </div>
    </header>

    <div>
        <img class="Topline" src="./image/haikeiTop.png">
    </div>
    <?php require 'footer.php'?>

<link rel="stylesheet" href="./css/footer.css">
</body>
</html>
