<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../../config/db-connect.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>スレッド作成</title>
  <link rel="stylesheet" href="./css/inquiry.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="inquiry-box">
        <form action="send_email.php" method="post">
        <div class="return">
            <button class="return-button" type="button" onclick="history.back()">閉じる</butto>
        </div>
        <h2>お問い合わせフォーム</h2>
            <div class="mail-reason">
                <!--メールアドレス-->
                <div class="mail">
                    <label for="email">メールアドレス　:</label>
                    <input type="email" id="email" name="email" size="33" required><br><br>
                </div>
                <!--お問い合わせ理由-->
                <div class="reason">
                    <label for="reason">お問い合わせ理由:</label>
                    <select name="reason" id="reason" required>
                        <option value="アカウント停止に対するお問い合わせ">アカウント停止に対するお問い合わせ</option>
                        <option value="ログインに関するお問い合わせ">ログインに関するお問い合わせ</option>
                        <option value="バグ・アイディア等のお問い合わせ">バグ・アイディア等のお問い合わせ</option>
                    </select><br><br>
                </div>

                <!--その他-->
                <div class="inputre">
                    <label for="inputre">その他：</label><br>
                    <textarea name="inputre" id="inputre" rows="3" cols="56"></textarea><br>
                </div>
                <div class="submit-button">
                    <input class="button" type="submit" value="送信">
                </div>
            </div>
        </form>
    </div>
</body>
</html>