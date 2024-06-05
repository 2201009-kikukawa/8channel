<?php
session_start();
ob_start(); // 出力バッファリングを開始

require '../../config/db-connect.php'; // db-connect.phpで$pdoが設定されていることを確認
require 'header.php';

// HTMLフォームがPOSTされた場合の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータの取得
    $tags = $_POST['tags'];

    // タグをデータベースに挿入
    foreach ($tags as $tag) {
        // SQLインジェクションを防止するために、プリペアドステートメントを使用する
        $sql = "INSERT INTO Tag (tag_name) VALUES (?)"; // テーブル名 'tag' を 'Tag' に修正
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$tag]);
    }

    // タグの追加が完了したらリダイレクトなどを行う
    // 例えば、追加されたタグを表示するページにリダイレクトする
    header("Location: tag_output.php");
    exit;
}
?>


</script>
</body>
</html>
