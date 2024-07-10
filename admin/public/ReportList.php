<?php
    require '../../config/db-connect.php';
?>

<head>
    <link rel="stylesheet" type="text/css" href="./css/ReportList.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
        <form method="post" id="form2">
            <input id="sbox3" type="text" name="search_id" placeholder="報告側のIDを入力">
            <button id="sbtn4" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <a class="aa" href="#" onclick="redirectToTagInput()">タグ作成</a>
        <a class="a1" href="StopUser.php">停止アカウント一覧へ</a>
        <a class="a2" href="logout.php">ログアウト</a>
    <div class="scroll">
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
                    echo '<td>', '<a class="a5" href="message.php?user_id=', $row['user_id'], '">', $row['user_id'], '</a>', '</td>';
                    echo '<td>', '<a class="a6" href="message.php?user_id=', $row['report_user'], '">', $row['report_user'], '</a>', '</td>';
                    echo '<td>';
                        switch ($row['report_reason']) {
                            case 1:
                                echo '迷惑なコメント';
                                break;
                            case 2:
                                echo '暴力的なコメント';
                                break;
                            case 3:
                                echo '卑猥なコメント';
                                break;
                            default:
                            echo $row['report_reason']; // デフォルトはそのまま表示
                            break;
                        }
                    echo '</td>';
                    echo '<td>', $row['data'], '</td>';
                    echo '</tr>';
                }   
            }
        ?>
        </table>
    </div>
    <script>
        function redirectToTagInput() {
            window.location.href = 'tag_input.php';
        }
    </script>
</body>