<?php
session_start();
//if($_SESSION['login'] == 'admin'){
?>
<!DOCTYPE html>
<html> 
    <head>
        <title>Register | WassUp!</title>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="css/create_account.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
    </head>
    <body>
        <ul class="text-animation hidden">
            <li>R</li>
            <li>e</li>
            <li>g</li>
            <li>i</li>
            <li>s</li>

            <li>t</li>
            <li>e</li>
            <li>r</li>
            <li>!</li>
        </ul>
        <div class="box">
            <form method="POST">
                <input type = "text" name = "id" required = "true" placeholder="Enter Your ID">
                <input type = "password" name = "pw" required = "true" placeholder="Enter Your Password">
                <input type ="text" name = "nkn" required = "true" placeholder="Enter Your Nickname">

                <a>Gender:</a>
                <input type = "radio" name = "sex" required = "true"><a>Male</a>
                <input type = "radio" name = "sex"><a>Female</a>
                <input type = "radio" name = "sex"><a>Others</a><br>                
                <h2>Most favorite animal ?</h2>
                <input type = "text" name = "security" required = "true"><br><br>
                <input type = "submit" value ="Register">
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
    if(empty(@$_POST['id']) == false && empty(@$_POST['pw']) == false && empty(@$_POST['nkn']) == false && empty(@$_POST['sex']) == false && empty(@$_POST['security']) == false){

        $sth = $dbh->prepare('insert into users (id,pw,name,gender,problem) values (?,?,?,?,?) ;');
        $sth->execute(array(@$_POST['id'],@$_POST['pw'],@$_POST['nkn'],@$_POST['sex'],@$_POST['security']));
        echo "<script>alert('Password has been modified!')</script>";
        echo "<script type='text/javascript'>";
            echo "window.location.href='index.php'";
        echo "</script>";  
    }
    if(isset($_POST['id'])){
		$inst = 'create table if not exists '.$_POST['id'].'_list (list_name VARCHAR(50));';
		$sth = $dbh->prepare($inst);
		$sth->execute();
	}
?> 