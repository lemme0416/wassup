<?php
session_start();

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
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <!-- <link rel="stylesheet" href="css/index.css"> -->
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <!-- <script src="js/index.js"></script> -->
    </head>
    <body>
        <frameset rows="7*,1*">
            <frameset cols="1*,5*">
                <frame src="left.php" name="left" frameborder="0">
                <frame src="yellow.php" name="right" frameborder="0">
            </frameset>
            <frame src="music.html" name="music" noresize="noresize" frameborder="0"></frame>
        </frameset>
    </body>
</html>