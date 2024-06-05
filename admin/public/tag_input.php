<?php
session_start();
ob_start(); // 出力バッファリングを開始

require '../../config/db-connect.php'; // db-connect.phpで$pdoが設定されていることを確認
require 'header.php';

$errors = []; // エラーメッセージを格納する配列
$success = false; // 成功メッセージのフラグ

// HTMLフォームがPOSTされた場合の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータの取得
    $tags = $_POST['tags'];

    // 重複しているタグを格納する配列
    $duplicate_tags = [];

    // タグをデータベースに挿入
    foreach ($tags as $tag) {
        // タグ名の重複を確認
        $sql_check_duplicate = "SELECT * FROM Tag WHERE tag_name = ?";
        $stmt_check_duplicate = $pdo->prepare($sql_check_duplicate);
        $stmt_check_duplicate->execute([$tag]);
        $existing_tag = $stmt_check_duplicate->fetch();

        if ($existing_tag) {
            // 重複するタグを配列に追加
            $duplicate_tags[] = $tag;
        } else {
            // SQLインジェクションを防止するために、プリペアドステートメントを使用する
            $sql_insert_tag = "INSERT INTO Tag (tag_name) VALUES (?)"; // テーブル名 'tag' を 'Tag' に修正
            $stmt_insert_tag = $pdo->prepare($sql_insert_tag);
            $stmt_insert_tag->execute([$tag]);
        }
    }

    // 重複しているタグがある場合の処理
    if (!empty($duplicate_tags)) {
        $error_message = "以下のタグが重複しています:";
        $tag_counts = array_count_values($duplicate_tags);
        foreach ($tag_counts as $tag => $count) {
            $error_message .= "\\n{$tag} ({$count}個)";
        }
        $errors[] = $error_message;
    }

    // エラーがなければリダイレクト
    if (empty($errors)) {
        $success = true; // 成功メッセージのフラグを立てる
        echo "<script>
            alert('タグが作成されました。');
            window.location.href = 'tag_input.php';
        </script>";
        exit();
    } else {
        // エラーがある場合の処理
        $error_messages = implode("\\n", $errors);
        echo "<script>
            alert('{$error_messages}');
            window.location.href = 'tag_input.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>タグ作成フォーム</title>
</head>
<body>
<h1>タグ作成</h1>
<?php if (!empty($errors)): ?>
    <div class="error-messages">
        <?php echo implode('<br>', $errors); ?>
    </div>
<?php endif; ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div id="container">
        <div class="textbox-container">
            <input type="text" name="tags[]" placeholder="タグ1">
        </div>
    </div>
    <button type="button" onclick="addTextBox()">+</button>
    <button type="submit">作成</button>
</form>
<button onclick="goBack()">戻る</button>
<script>
    let textBoxCounter = 1;

    function addTextBox() {
        textBoxCounter++;

        const container = document.getElementById("container");
        const textBoxContainer = document.createElement("div");
        textBoxContainer.className = "textbox-container";

        const textBox = document.createElement("input");
        textBox.type = "text";
        textBox.name = "tags[]";
        textBox.placeholder = "タグ " + textBoxCounter;

        textBoxContainer.appendChild(textBox);
        container.appendChild(textBoxContainer);
    }
    function goBack() {
        window.location.href = 'ReportList.php';
    }
</script>
</body>
</html>
