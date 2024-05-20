<?php
    require '../../config/db-connect.php';
    require 'header.php';
?>

<body>
    <form method="post">
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
        /**echo 1;
        echo "<br>====<br>";
        var_dump($_POST);
        echo "<br>====<br>";
            // ユーザーIDが入力された場合の処理
            if(!empty($_POST['search'])){
            echo 2;

                $sql=$conn->prepare('select * from Stop_user where user_id = ?');
                $sql->execute([$_POST['search']]);
                var_dump($sql);
             }else{ // 入力がない場合は全てのレポートを表示
            echo 3;
                $sql=$conn->query('select * from Stop_user');
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
</body>**/
if (!empty($_POST['search'])) {
            $search_id = $_POST['search'];

            // Stop_userテーブルからユーザー情報を取得
            $sql_stop_user = $conn->prepare('SELECT * FROM Stop_user WHERE user_id = ?');
            $sql_stop_user->execute([$search_id]);

            foreach ($sql_stop_user as $stop_user_row) {
                // Userテーブルからユーザー名を取得
                $sql_user = $conn->prepare('SELECT user_name FROM User WHERE user_id = ?');
                $sql_user->execute([$stop_user_row['user_id']]);
                $user_row = $sql_user->fetch();

                // テーブルに表示
                echo '<tr>';
                echo '<td>', $stop_user_row['user_id'], '</td>';
                echo '<td>', $user_row['user_name'], '</td>';
                echo '<td>', $stop_user_row['stop_reason'], '</td>';
                echo '<td>';
                echo '<form action="" method="post">';
                echo '<input type="hidden" name="id" value="', $stop_user_row['user_id'], '">';
                echo '<button type="submit">解除</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
        } else { // 入力がない場合は全てのレポートを表示
            $sql_stop_user = $conn->query('SELECT * FROM Stop_user');

            foreach ($sql_stop_user as $stop_user_row) {
                // Userテーブルからユーザー名を取得
                $sql_user = $conn->prepare('SELECT user_name FROM User WHERE user_id = ?');
                $sql_user->execute([$stop_user_row['user_id']]);
                $user_row = $sql_user->fetch();

                // テーブルに表示
                echo '<tr>';
                echo '<td>', $stop_user_row['user_id'], '</td>';
                echo '<td>', $user_row['user_name'], '</td>';
                echo '<td>', $stop_user_row['stop_reason'], '</td>';
                echo '<td>';
                echo '<form action="" method="post">';
                echo '<input type="hidden" name="id" value="', $stop_user_row['user_id'], '">';
                echo '<button type="submit">解除</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
        }
        ?>
    </table>
</body>