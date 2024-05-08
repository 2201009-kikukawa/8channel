<?php
//db設定ファイル
$servername = "mysql304.phy.lolipop.lan"; 
$username = "LAA1516915"; 
$password = "Pass1111"; 
$dbname = "LAA1516915-8cannel"; 

//db接続用変数
$connect = new mysqli($servername, $username, $password, $dbname);

//接続エラーチェック
if ($connect->connect_error) {
    die("データベースに接続できませんでした: " . $conn->connect_error);
} else {
    $output = "データベースに接続しました\n";
    fwrite(STDOUT, $output);
}
?>
