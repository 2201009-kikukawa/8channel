<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <h2>
            <u>ID：○○○○の投稿一覧</u>
        </h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">月日</th>
                    <th scope="col">投稿内容</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>5/13</td>
                    <td>wwwwwwwww</td>
                </tr>
                <tr>
                    <td>5/14</td>
                    <td>wwwwwwwww</td>
                </tr>
                <tr>
                    <td>5/15</td>
                    <td>wwwwwwwww</td>
                </tr>
                <tr>
                    <td>5/16</td>
                    <td>wwwwwwwww</td>
                </tr>
            </tbody>
        </table>
        <button onclick="stopFunction()">停止</button>
        <button onclick="goBack()">戻る</button>
    </main>
    <script>
        function stopFunction() {
            // 何らかの処理を実行して停止する
            alert("停止しました。");
        }
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
