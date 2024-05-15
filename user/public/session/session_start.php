<?php
    session_start();
    //ゲストデータ保存
    $_SESSION['User']['id']='id';
    $_SESSION['User']['mail']='gest';
    $_SESSION['User']['name']='gest';
    //id,mail,nameを取得
    $id   = $_SESSION['User']['id'];
    $mail = $_SESSION['User']['mail'];
    $name = $_SESSION['User']['name'];
?>