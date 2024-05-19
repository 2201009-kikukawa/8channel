<?php
    session_start();
    $_SESSION['User']['id'] = 'gest';
    $_SESSION['User']['mail'] = 'gest';
    $_SESSION['User']['name'] = 'gest';
    unset($_SESSION['name']);
    var_dump($_SESSION);
    $_SESSION = array();
    var_dump($_SESSION);
?>
