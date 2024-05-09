<?php require '../../config/db-connect.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReportList</title>
</head>
<body>
    <?php
        echo "<input type=text placeholder="."IDを入力".">";
        echo "<input type=button value=検索>";
        echo "<a href="."logout.php".">ログアウト</a>";
        echo "<br>";
        echo "<a href="."StopUser.php".">停止アカウント一覧へ</a>";
        echo '<table>';
    echo '<tr><th>報告したユーザーID</th><th>報告されたユーザーID</th><th>報告内容</th><th>日付</th></tr>';
    $pdo=new PDO('mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1516915-8cannel;charset=utf8','LAA1516915','Pass1111');
    $sql=$pdo->query('select * from Report');
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