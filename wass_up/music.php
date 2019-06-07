<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);
require_once('login.php');
$dsn = 'mysql:host=localhost;dbname=wassup';
$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
$sth = $dbh->prepare('select name from music order by id;');
//$sth->bindparam("ss");
$sth->execute();
/*
while ($result = $sth->fetch()){
    echo json_encode($result);
}
*/
$result = $sth->fetchAll();
//$outp = $result->fetch_all(MYSQLI_ASSOC);

//echo json_encode($result);
echo json_encode($result);

?>