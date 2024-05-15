<?php require '../../config/db-connect.php' ;?>
<?php require 'session/session_start.php' ;?>

<?php
    $sql = $conn -> prepare('select * from  User mail = ?');
    $sql -> execute([$_POST['mail']]);
    foreach ($sql as $row) {
        if(password_verify($_POST['pass'],$row['password']) == true){
            $_SESSION['User']=[
                'id' => $row['user_id'],
                'mail' => $row['mail'],
                'name' => $row['user_name']
            ];
        }
    }
    if (isset($_SESSION['User'])) {
        header('Location: Top.php');
        exit();
    } else {
        header('Location: login.php');
        exit();
    }
?>