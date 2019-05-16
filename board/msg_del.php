<?php
ob_start();
require("board.php");

$sql =<<<EOF
    DELETE from MSG where ID='$_GET[ID]';
EOF;
$ret = $db->exec($sql);
if(!$ret){
    echo $db->lastErrorMsg();
} else {
    echo "成功";
}

header('Location: board.php');
ob_end_flush();

?>