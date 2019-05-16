<?php
ob_start();
require("board.php");
error_reporting(0);

if(isset($_POST['edit_submit'])==true && empty($_POST['edit_msg'])==false&&empty($_GET['ID'])==false){

    $UpdateNewMsg = 'UPDATE MSG set CONTENTS="'.$_POST['edit_msg'].'" where ID="'.$_GET['ID'].'";';
//     $UpdateNewMsg = <<<EOF
//         UPDATE MSG set CONTENTS = '$_POST['edit_msg']' where ID='$_GET[ID]';
// EOF;
    $UpdateNewMsg_ret = $db->exec($UpdateNewMsg);

    if(!$UpdateNewMsg_ret){
        $fail_flag=true;
        echo $db->lastErrorMsg();

    }else{
        echo $_GET['ID'];
        echo "adsfasf";
        $success_flag=true;

    }
}
header('Location: board.php');
ob_end_flush();   

$db->close();
?>