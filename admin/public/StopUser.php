<?php
    require '../../config/db-connect.php';
    require 'header.php';
?>

<body>
    <form action="StopUser.php" method="post">
        <input type="text" name="search" placeholder="IDを入力">
        <input type="submit" value="検索">
    </form>
    <input type=button value=タグ作成 onclick="redirectToTagInput()">
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
            // ユーザーIDが入力された場合の処理
            if(!empty($_POST['search'])){
            $search_id = $_POST['search'];
                $sql = $pdo->prepare('SELECT su.user_id, u.user_name, su.stop_reason 
                                   FROM stop_user su 
                                   JOIN user u ON su.user_id = u.user_id 
                                   WHERE su.user_id = ?');
                $sql->execute([$search_id]);
             }else{ // 入力がない場合は全てのレポートを表示
                $sql = $pdo->query('SELECT su.user_id, u.user_name, su.stop_reason 
                                 FROM stop_user su 
                                 JOIN user u ON su.user_id = u.user_id');
             }

            // 検索結果の行数を取得
            $rowCount = $sql->rowCount();

            if($rowCount === 0) { // データがない場合
                echo '<tr><td colspan="4">データが見つかりません</td></tr>';
            } else { // データがある場合
                foreach($sql as $row) {
                    echo '<tr>';
                    echo '<td>', $row['user_id'], '</td>';
                    echo '<td>', $row['user_name'], '</td>';
                    echo '<td>', $row['stop_reason'], '</td>';
                    echo '<td>';
                        echo '<form action="UserLift_input.php" method="post">';
                            echo '<input type="hidden" name="id" value="', $row['user_id'], '">';
                            echo '<button type="submit">解除</button>';
                        echo '</form>';
                    echo '</td>';
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