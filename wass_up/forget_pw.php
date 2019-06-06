<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>忘記密碼 | WassUp!</title>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="forget_pw.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <script src="forget_pw.js"></script>
    </head>
    <body background = "pw.jpg">
        <form method="POST">
            ID:<input type = "text" name = "id" id = "id"><br>
            security question: <input type = "text" name = "security" id = "security"><br>
            <input type = "submit" value ="finish">
            <input type = "button" value = "返回" onclick = "javascript:location.href='index.php'">
        </form>
    </body>
</html>
<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);   
    $sth = $dbh->prepare('select count(*) as r from users where id = ? and problem = ? ;');
    $sth->execute(array(@$_POST['id'],@$_POST['security']));
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if($result['r'] == 1 ){
        $_SESSION['login'] = $_POST['id'];
        $url = "modify_pw.php";
        echo "<script type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>";
        $sth = $dbh->prepare('update  users set pw = ? where id = ?');
        $sth->execute(array($_POST['pw'],$_POST['id']));
    }
?> 