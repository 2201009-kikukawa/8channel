<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント停止確認</title>
    <script>
        function confirmStop() {
            alert("アカウントを停止しました。");
            // サーバーにリクエストを送信するなどの処理をここに追加
        }

        function cancelStop() {
            window.location.href = 'message.php';
            // 必要に応じて処理をここに追加
        }
    </script>
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <h1>アカウントを停止してもよろしいですか？</h1>
        <p>ユーザーID:</p>
        <p>ユーザー名:</p>
        <select name="detail">
            <option value="0">停止理由を選択してください</option>
            <option value="1">理由1</option>
            <option value="2">理由2</option>
            <option value="3">理由3</option>
        </select>

        <div class="button-container">
            <button class="button-yes" onclick="confirmStop()">はい</button>
            <button class="button-no" onclick="cancelStop()">いいえ</button>
        </div>
    </main>
</body>

</html>
