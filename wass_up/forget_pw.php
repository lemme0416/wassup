<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Forget? | WassUp!</title>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="css/forget_pw.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>    
    </head>
    <body>
        <ul class="text-animation hidden">
            <li>F</li>
            <li>o</li>
            <li>r</li>
            <li>g</li>
            <li>e</li>
            <li>t</li>
            <li>?</li>
        </ul>
        <div class="box">        
            <form method="POST">
                <input type = "text" name = "id" id = "id" placeholder="Your ID"><br>
                <h2>Favorite animal?</h2>
                <input type = "text" name = "security" id = "security"placeholder="Your answer"><br>
                <input type = "submit" value ="Confirm">
                <input type = "button" value = "HomePage" onclick = "javascript:location.href='index.php'">
            </form>
        </div>
        <script type="text/javascript">
            $(function(){
                setTimeout(function(){
                    $('.text-animation').removeClass('hidden');
                }, 500);
            });
        </script>
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
        $url = "modify_pw_visitor.php";
        echo "<script type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>";
        $sth = $dbh->prepare('update  users set pw = ? where id = ?');
        $sth->execute(array($_POST['pw'],$_POST['id']));
    }
?> 