<?php
session_start();
?>
<body background = "pw.jpg">
<form method="POST">
ID:<input type = "text" name = "id" id = "id"><br>
security question: <input type = "text" name = "security" id = "security"><br>
<input type = "submit" value ="finish"><input type = "button" value = "return" onclick = "javascript:location.href='index.php'">
</form>
</body>
<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);   
    $sth = $dbh->prepare('select count(*) as r from users where id = ? and problem = ? ;');
    $sth->execute(array(@$_POST['id'],@$_POST['security']));
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if($result['r'] == 1 ){
        $_SESSION['login'] = $_POST['id'];
        $url = "modifypw.php";
        echo "<script type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>";
        $sth = $dbh->prepare('update  users set pw = ? where id = ?');
        $sth->execute(array($_POST['pw'],$_POST['id']));
    }
?> 