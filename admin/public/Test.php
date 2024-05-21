<?php
    require '../../config/db-connect.php';
    require 'header.php';
?>

<body>
    <form action="StopUser.php" method="post">
        <input type="text" name="search" placeholder="IDを入力">
        <input type="submit" value="検索">
    </form>
        <input type=button value=タグ作成>
        <br>
        <a href="ReportList.php">報告一覧へ</a>
        <a href="logout.php">ログアウト</a>
    <table>
        <tr>
            <th>ユーザーID</th>
            <th>ユーザー名</th>
            <th>停止理由</th>
            <th>削除ボタン</th>
        </tr>
    
        <?php
        echo 1;
        echo "<br>====<br>";
        var_dump($_POST);
        echo "<br>====<br>";
        $pdo=new PDO('mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1516915-8cannel;charset=utf8','LAA1516915','Pass1111');
            // ユーザーIDが入力された場合の処理
            if(isset($_POST['search'])){
            echo 2;
                $sql = $pdo->prepare('SELECT su.user_id, u.user_name, su.stop_reason 
                                   FROM Stop_user su 
                                   JOIN User u ON su.user_id = u.user_id 
                                   WHERE su.user_id = ?');
                $sql->execute($_POST['search']);
             }else{ // 入力がない場合は全てのレポートを表示
            echo 3;
                $sql = $pdo->query('SELECT su.user_id, u.user_name, su.stop_reason 
                                 FROM Stop_user su 
                                 JOIN User u ON su.user_id = u.user_id');
             }

            foreach($sql as $row) {
                echo '<tr>';
                    echo '<td>', $row['user_id'], '</td>';
                    echo '<td>', $row['user_name'], '</td>';
                    echo '<td>', $row['stop_reason'], '</td>';
                    echo '<td>';
                        echo '<form action="" method="post">';
                            echo '<input type="hidden" name="id" value="', $row['user_id'], '">';
                            echo '<button type="submit">解除</button>';
                        echo '</form>';
                    echo '</td>';
                echo '</tr>';
            }
        ?>
    </table>
</body>