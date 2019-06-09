<?php
    if(isset($_POST['list_name'])){
        require_once('login.php');
        $dsn = 'mysql:host=localhost;dbname=wassup';
        $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
        $inst = 'create table '.$_SESSION['login'].'_list_'.$_POST['list_name'].' (song VARCHAR(100));';
        $sth = $dbh->prepare($inst);
        $sth->execute();
        $inst = 'insert into '.$_SESSION['login'].'_list (' .$_POST['list_name'].');';
        $sth = $dbh->prepare($inst);
        $sth->execute();
    }
    header("Location: left.php");
?>