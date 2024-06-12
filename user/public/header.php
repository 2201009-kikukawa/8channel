<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8channel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header class="bg-light p-3 border-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <a href="Top-index.php"><img src="./image/rogo.jpg" alt="Site Logo" style="height: 50px;"></a>
            </div>
            
            <div>
                <h1 class="h4">8channel</h1>
                <p class="mb-0 text-muted">Your gateway to unlimited channels</p>
            </div>

            <div>
                <?php if (isset($_SESSION['User']['id'])) :?>
                    <a href="./logout.php" class="btn btn-outline-primary">Logout</a>
                <?php else: ?>
                    <a href="./login.php" class="btn btn-primary">Login</a>
                <?php endif; ?>
                <a href="../../admin/public/login_input.php" class="btn btn-link">Admin Login</a>
            </div>
        </div>
    </header>
</body>
</html>
