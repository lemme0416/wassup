<?php
    if(isset($_POST['list_name'])){
        session_start();
        require_once('login.php');
        $dsn = 'mysql:host=localhost;dbname=wassup';
        $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
        $inst = 'create table if not exists '.$_SESSION['login'].'_list_'.$_POST['list_name'].' (id INT(11), name VARCHAR(100), CONSTRAINT song_unique UNIQUE (id, name));';
        $sth = $dbh->prepare($inst);
        $sth->execute();
        $inst = 'insert into '.$_SESSION['login'].'_list(list_name) values (?);';
        $sth = $dbh->prepare($inst);
        $sth->execute(array($_POST['list_name']));
    }
    header("Location: left.php");
?>