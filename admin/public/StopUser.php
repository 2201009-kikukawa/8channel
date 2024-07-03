<?php
    require '../../config/db-connect.php';
?>

<header>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</header>

<body>
<link rel="stylesheet" href="css/StopUser.css">
        <form method="post" id="form2">
            <input id="sbox3" type="text" name="search" placeholder="ユーザーIDを入力">
            <button id="sbtn4" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    <a class="aa" href="#" onclick="redirectToTagInput()">タグ作成</a>
    <a class="a1" href="ReportList.php">報告一覧へ</a>
    <a class="a2" href="logout.php">ログアウト</a>
    <table>
        <tr>
            <th>ユーザーID</th>
            <th>ユーザー名</th>
            <th>停止理由</th>
            <th>解除ボタン</th>
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
                            echo '<button class="xx" type="submit">解除</button>';
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