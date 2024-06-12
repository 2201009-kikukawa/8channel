<?php
require '../../config/db-connect.php';

if(isset($_POST['th_name'])) {
    $th_name = $_POST['th_name'];

    // スレッド名の被りをチェック
    $query = "SELECT COUNT(*) AS count FROM thread WHERE thread_name = :th_name";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':th_name', $th_name);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result['count'] > 0) {
        echo '<span style="color: red;">このスレッド名は既に使われています。</span>';
    } else {
    }
}
?>
