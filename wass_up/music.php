<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET['x'], false);
require_once('login.php');
$dsn = 'mysql:host=localhost;dbname=wassup';
$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
//table name 不能用?去頂 改用字串接起來
$str = 'select name from '.$obj->table.' order by id;';
$sth = $dbh->prepare($str);
$sth->execute();

$result = $sth->fetchAll();

//echo $result;
echo json_encode($result);
/*
var_dump($result);
echo '<br>';
//echo $str;
echo $_GET['x'];
echo $obj->table;
*/
?>