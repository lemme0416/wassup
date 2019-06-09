<?php
session_start();
//if($_SESSION['login'] == 'admin'){
?>
<!DOCTYPE html>
<html> 
    <head>
        <title>Create | WassUp!</title>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="css/create_account.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <script src="js/create_account.js"></script>
    </head>
    <body>
        <ul class="text-animation hidden">
            <li>W</li>
            <li>a</li>
            <li>s</li>
            <li>s</li>
            <li>U</li>
            <li>p</li>
            <li>!</li>
        </ul>
        <div class="box">
            <form method="POST">
                <input type = "text" name = "id" require = "true" placeholder="Enter Your ID"><br>
                <input type = "password" name = "pw" require = "true" placeholder="Enter Your Password"><br>
                <input type ="text" name = "nkn" require = "true" placeholder="Enter Your Nickname"><br>
                <input type = "text" name = "sex" require = "true"><br>
                security word<input type = "text" name = "security"><br>
                <!-- submit 創帳號 return回首頁 -->
                <input type = "submit" value ="create">
                <input type = "button" value = "return" onclick = "javascript:location.href='index.php'"> 
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
    $sth = $dbh->prepare('insert into users (id,pw,name,gender,problem) values (?,?,?,?,?) ;');
    $sth->execute(array(@$_POST['id'],@$_POST['pw'],@$_POST['nkn'],@$_POST['sex'],@$_POST['security']));
	if(isset($_POST['id'])){
		$inst = 'create table if not exists '.$_POST['id'].'_list (list_name VARCHAR(50));';
		$sth = $dbh->prepare($inst);
		$sth->execute();
	}
?> 