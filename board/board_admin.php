<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=s106062131';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    $sth = $dbh->prepare('select * from test order by no ;');
    $sth->execute();
?>
<html>
<head>
<title>管理員留言板</title>
</head>
<style>
    body{
        text-align:center;
        background-image:url( 'board.jpg' );
        background-size:cover;
    }
    #div1{
        position:absolute;
        left:50%;
        margin-left:-150px;
        margin-top:30px;
    }
    #btn{
        font-size: 32px;

    }
    #btn:hover{background-color:blue};

</style>
<body >
<input type = "button" name = "send" id = "btn" value = "留言" onclick = "javascript:location.href='sendmsg.php'">
<input type = "button" name = "logout" id = "btn" value = "登出" onclick = "javascript:location.href='index.php'">
<input type = "button" name = "logout" id = "btn" value = "修改密碼" onclick = "javascript:location.href='midifypw.php'">
<input type = "button" name = "delete" id = "btn" value = "刪除留言" onclick = "javascript:location.href='delete.php'">
<input type = "button" name = "delete" id = "btn" value = "修改留言" onclick = "javascript:location.href='modifymsg.php'">
<div id = "div1">
    <?php
        echo '<table border = "1">';
        echo '<tr><td>'."No.".'</td><td>'."name".'</td><td>'."msg".'</td><td>'."time".'</td><td>'."gender".'</td></tr>';
        while ($row = $sth->fetch()){
            echo '<tr><td>'.$row['no'].'</td><td>'.htmlentities($row['id']).'</td><td>'.htmlentities($row['msg']).'</td><td>'.htmlentities($row['time']).'</td><td>'.htmlentities($row['gender']).'</td></tr>';
        }
        echo '<table>';
    ?>

</div>
</body>
</html>

    