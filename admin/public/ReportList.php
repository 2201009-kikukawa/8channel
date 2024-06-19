<?php
    require '../../config/db-connect.php';
    require 'header.php';
?>

<head>
    <link rel="stylesheet" type="text/css" href="./css/ReportList.css">
</head>
<body>
    <form method="post">
        <input type="text" name="search_id" placeholder="報告側のIDを入力">
        <input type="submit" value="検索">
    </form>
        <input type=button value=タグ作成 onclick="redirectToTagInput()">
        <br>
    <div class="a1">
        <a href="StopUser.php">停止アカウント一覧へ</a>
        <a href="logout.php">ログアウト</a>
    </div>
        <table class="a2">
        <tr>
            <th>報告したユーザーID</th>
            <th>報告されたユーザーID</th>
            <th>報告内容</th>
            <th>日付</th>
        </tr>
    
        <?php
            // ユーザーIDが入力された場合の処理
            if(!empty($_POST['search_id'])){

                $sql=$pdo->prepare('select * from report where user_id = ?');
                $sql->execute([$_POST['search_id']]);
             }else{ // 入力がない場合は全てのレポートを表示
                $sql=$pdo->query('select * from report');
             }

            // 検索結果の行数を取得
            $rowCount = $sql->rowCount();

            if($rowCount === 0) { // 検索結果がない場合
                echo '<tr><td colspan="4">データが見つかりません</td></tr>';
            } else { // 検索結果がある場合
                foreach($sql as $row) {
                    echo '<tr>';
                    echo '<td>', '<a href="message.php?user_id=', $row['user_id'], '">', $row['user_id'], '</a>', '</td>';
                    echo '<td>', '<a href="message.php?user_id=', $row['report_user'], '">', $row['report_user'], '</a>', '</td>';
                    echo '<td>', $row['report_reason'], '</td>';
                    echo '<td>', $row['data'], '</td>';
                    echo '</tr>';
                }
            }
        ?>
    </table>
    <script>
        function redirectToTagInput() {
            window.location.href = 'tag_input.php';
        }
    </script>
</body>