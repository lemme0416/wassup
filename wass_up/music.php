<?php
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_GET["x"], false);
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    $sth = $dbh->prepare('select music from music order by id;');
    $sth->bind_param("sss");
    $sth->execute();
    $result = $sth->get_result();
    $outp = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($outp);
?>

