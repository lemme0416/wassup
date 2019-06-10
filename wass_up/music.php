<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);
require_once('login.php');
$dsn = 'mysql:host=localhost;dbname=wassup';
$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
$sth = $dbh->prepare('select (*) from ? order by id;');
//$sth->bindparam("ss");
$sth->execute(arraxy($obj->table));

while ($result = $sth->fetch()){
    echo $result;
}

$result = $sth->fetchAll();
//$outp = $result->fetch_all(MYSQLI_ASSOC);

//echo $result;
echo json_encode($result);

?>