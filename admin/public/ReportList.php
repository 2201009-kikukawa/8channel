<?php
    require '../../config/db-connect.php';
    require 'header.php';
?>
<head>
    <link rel="stylesheet" type="text/css" href="./css/ReportList.css">
    <style>
        body {
            background-color: black;
            color: white;
            padding-top: 50px; /* 上部の余白を追加 */
            margin: 0; /* デフォルトのmarginをリセット */
        }
        table {
            border-collapse: collapse;
            width: 65%; /* 横幅の70%に設定 */
            margin: auto; /* 中央に配置 */
            border: 2px solid #9ACD32; /* テーブルのラインを黄緑に設定 */
            margin-top: 20px; /* テーブル上部の余白を追加 */
            margin-bottom: 20px; /* テーブル下部の余白を追加 */
        }
        th {
            background-color: black; /* thタグの背景を黒に設定 */
            color: white; /* thタグのテキストを白に設定 */
            border: 1px solid #dddddd;
            text-align: center; /* 中央揃えに設定 */
            padding: 8px;
        }
        td {
            border: 1px solid #dddddd;
            text-align: center; /* 中央揃えに設定 */
            padding: 8px;
        }
        a {
            color: white; /* リンクのテキストを白に設定 */
            text-decoration: none; /* リンクの下線を削除 */
        }
        .container {
            max-width: 800px; /* 必要に応じて幅を調整 */
            margin: auto; /* 中央に配置 */
            margin-top: 20px; /* コンテナの上部の余白を追加 */
        }
    </style>
</head>
<body>
    <form method="post">
        <input type="text" name="search_id" placeholder="報告側のIDを入力">
        <input type="submit" value="検索">
    </form>
        <input type=button value=タグ作成>
        <br>
        <a href="StopUser.php">停止アカウント一覧へ</a>
        <a href="logout.php" class="logout">ログアウト</a>
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

                $sql=$pdo->prepare('select * from report where report_user = ?');
                $sql->execute([$_POST['search_id']]);
             }else{ // 入力がない場合は全てのレポートを表示
                $sql=$pdo->query('select * from report');
             }

            foreach($sql as $row) {
                echo '<tr>';
                    echo '<td>', '<a href="message.php?ユーザーID=', $row['report_user'], '">', $row['report_user'], '</a>', '</td>';
                    echo '<td>', '<a href="message.php?ユーザーID=', $row['user_id'], '">', $row['user_id'], '</a>', '</td>';
                    echo '<td>', $row['report_reason'], '</td>';
                    echo '<td>', $row['data'], '</td>';
                echo '</tr>';
            }
        ?>
    </table>
</body>