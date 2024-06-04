<?php
    require '../../config/db-connect.php';
    require 'header.php';
?>

<body>
    <form method="post">
        <input type="text" name="search_id" placeholder="報告側のIDを入力">
        <input type="submit" value="検索">
    </form>
        <input type=button value=タグ作成>
        <br>
        <a href="StopUser.php">停止アカウント一覧へ</a>
        <a href="logout.php">ログアウト</a>
    <table>
        <tr>
            <th>報告したユーザーID</th>
            <th>報告されたユーザーID</th>
            <th>報告内容</th>
            <th>日付</th>
        </tr>
    
        <?php
            // ユーザーIDが入力された場合の処理
            if(!empty($_POST['search_id'])){

                $sql=$pdo->prepare('select * from Report where report_user = ?');
                $sql->execute([$_POST['search_id']]);
             }else{ // 入力がない場合は全てのレポートを表示
                $sql=$pdo->query('select * from Report');
             }

            // 検索結果の行数を取得
            $rowCount = $sql->rowCount();

            if($rowCount === 0) { // 検索結果がない場合
                echo '<tr><td colspan="4">データが見つかりません</td></tr>';
            } else { // 検索結果がある場合
                foreach($sql as $row) {
                    echo '<tr>';
                    echo '<td>', '<a href="message.php?user_id=', $row['report_user'], '">', $row['report_user'], '</a>', '</td>';
                    echo '<td>', '<a href="message.php?user_id=', $row['user_id'], '">', $row['user_id'], '</a>', '</td>';
                    echo '<td>', $row['report_reason'], '</td>';
                    echo '<td>', $row['data'], '</td>';
                    echo '</tr>';
                }
            }
        ?>
    </table>
</body>