<?php
    require '../../config/db-connect.php';
    require 'header.php';
?>

<body>
    <form method="post">
        <input type="text" name="search_id" placeholder="IDを入力">
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
            if(isset($_POST['search_id'])){
                $search_id = '%' . $_POST['search_id'] . '%'; // ワイルドカードを追加
                $sql=$conn->prepare('SELECT * FROM Report WHERE user_id LIKE ?');
                $sql->execute([$search_id]); // 配列に変更
             }else{ // 入力がない場合は全てのレポートを表示
                $sql=$conn->query('SELECT * FROM Report');
             }

            foreach($sql as $row) {
                echo '<tr>';
                echo '<td>', $row['report_user'], '</td>';
                echo '<td>', $row['user_id'], '</td>';
                echo '<td>', $row['report_reason'], '</td>';
                echo '<td>', $row['data'], '</td>';
                echo '</tr>';
            }

        ?>
    </table>
</body