<?php
    require '../../config/db-connect.php';
    require 'header.php';
?>

<body>
    <?php
        echo "<input type=text placeholder="."IDを入力".">";
        echo "<input type=button value=検索>";
        echo "<input type=button value=タグ作成>";
        echo "<br>";
        echo "<a href="."StopUser.php".">停止アカウント一覧へ</a>";
        echo "<a href="."logout.php".">ログアウト</a>";
        echo '<table>';
    echo '<tr><th>報告したユーザーID</th><th>報告されたユーザーID</th><th>報告内容</th><th>日付</th></tr>';
    $sql=$conn->query('select * from Report');
    foreach($sql as $row){
            echo '<tr>';
            echo '<td>', $row['report_user'], '</td>';
            echo '<td>', $row['user_id'], '</td>';
            echo '<td>', $row['report_reason'], '</td>';
            echo '<td>', $row['data'], '</td>';
            echo '</tr>';
    
    }
    echo '</table>';
    ?>
</body>
</html>