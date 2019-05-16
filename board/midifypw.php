<?php
session_start();
?>
<body background = "pw.jpg">
<form method="POST">
old password:<input type = "password" name = "opw"><br>
new password:<input type = "password" name = "npw"><br>
enter new password again: <input type = "password" name = "npw2"><br>
<input type = "submit" value ="修改密碼"><input type = "button" value = "return"  onclick="history.back()">
</form>
</body>
<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=s106062131';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    $sth = $dbh->prepare('select count(*) as r from users where id = ? and pw = ? ;');
    $sth->execute(array($_SESSION['login'],$_POST['opw']));
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if($result['r'] == 1 && $_POST['npw'] == $_POST['npw2']){
        $sth = $dbh->prepare('update  users set pw = ? where id = ?');
        $sth->execute(array($_POST['npw'],$_SESSION['login']));
    }
    
    
?> 