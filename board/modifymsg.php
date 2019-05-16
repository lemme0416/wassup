<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=s106062131';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    $sth = $dbh->prepare('select * from test order by no ;');
    $sth->execute();
    echo '<table border = "1">';
    echo '<tr><td>'."No.".'</td><td>'."name".'</td><td>'."msg".'</td><td>'."time".'</td><td>'."gender".'</td></tr>';
    while ($row = $sth->fetch()){
        echo '<tr><td>'.$row['no'].'</td><td>'.htmlentities($row['id']).'</td><td>'.htmlentities($row['msg']).'</td><td>'.htmlentities($row['time']).'</td><td>'.htmlentities($row['gender']).'</td></tr>';
    }
    echo '<table>';

    ?>
<html>
<head>
<title>已編輯</title>
</head>

<style>
    #delete{
        background-color:lightblue ;
        position: absolute;
        top: 80px;
        right: 0;
        width: 500px;
        text-align: center;
        border: 3px solid #73AD21;
    }

</style>
<body  background = "pw.jpg">
<div id = "delete">
    <p id = "p">which msg you want to modify?</p>
    <form method="POST" >
    <input type = "number" min = "1" name = "num" >
    <p><textarea name="message" rows="8" cols="52"></textarea></p>
    <p><input type="submit" value="修改留言"> <input type ="button" value = "回留言板" onclick = "javascript:location.href='board_admin.php'">
</form>
</div>

</body>
</html>
<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=s106062131';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    $sth = $dbh->prepare('update  test set msg = ? where no = ?;');
    $sth->execute(array($_POST['message'],$_POST['num']));
    if ($_POST['num'] != ""){
        $url = "board_admin.php";
        echo "<script type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>"; 
    }
