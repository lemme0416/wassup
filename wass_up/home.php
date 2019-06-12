<?php
session_start();
//登入資料庫
require_once('login.php');
$dsn = 'mysql:host=localhost;dbname=wassup';
$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);

if (isset($_SESSION['login'])=='') {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Home | WassUp!</title>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />

    </head>
    <!-- 分成上下視窗 -->
    <frameset rows="8*,80*,9*" border="2" bordercolor=#240b36>
        <!-- 最上面的視窗 -->
        <frame src="search.php" name="top" noresize="noresize">
        <!-- 中間分成左右兩個視窗 -->
        <frameset cols="12*,50*">
            <frame src="left.php" name="left">
            <frame src="jsGame/index.php" name="right">
        </frameset>
        <!-- player -->
        <frame src="music.html" name="music" noresize="noresize">
    </frameset>
</html>