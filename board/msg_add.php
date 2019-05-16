<?php
    ob_start();
    require("board.php");

    date_default_timezone_set("Asia/Taipei");
    $date=date("Y-m-d h:ia");

    if (empty($_POST["msg"])==FALSE) {
        $SaveNewMsg = "INSERT INTO MSG (GUEST, CONTENTS, DATES) VALUES ('".$_SESSION['ID']."', '".$_POST['msg']."', '".$date."');";
        $SaveNewMsg_ret = $db->exec($SaveNewMsg);
    }

    if(!$SaveNewMsg_ret){
        echo "留言失敗";

    }else{
        echo "留言成功";
    }

    header('Location: board.php');
    ob_end_flush();

    $db->close();
?>