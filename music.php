<?php
header("Content-Type: application/json; charset=UTF-8");
// session_start();
$obj = json_decode($_GET['x'], false);
require_once('login.php');
$dsn = 'mysql:host=localhost;dbname=wassup';
$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
//table name 不能用?去頂 改用字串接起來
if ($obj->lan == 2){
    $str = 'select * from '.$obj->table.' order by id;';  
    $sth = $dbh->prepare($str);
    $sth->execute();
}
else{
    $str = 'select * from '.$obj->table.' where language = ?;';
    $sth = $dbh->prepare($str);
    $sth->execute(array($obj->lan));
}


$result = $sth->fetchAll();

// //echo $result;
echo json_encode($result);
/*
var_dump($result);
echo '<br>';
//echo $str;
echo $_GET['x'];
echo $obj->table;
*/
?>