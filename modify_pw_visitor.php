<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modify! | WassUp!</title>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="css/modify_pw_visitor.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>    
    </head>
    <body>
        <!-- 各種特效 -->
        <ul class="text-animation hidden" onclick="javascript:window.location.href='index.php'">
            <li>M</li>
            <li>o</li>
            <li>d</li>
            <li>i</li>
            <li>f</li>
            <li>y</li>
            <li>!</li>
        </ul>
        <!-- 修改密碼的地方 -->
        <div class="box">        
            <form method="POST">
                <input type = "password" name = "npw" required = "true" placeholder="New Password"><br>
                <input type = "password" name = "npw2" required = "true" placeholder="Enter New Password Again"><br>
                <input type = "submit" value ="Confirm">
            </form>
        </div>
        <!-- 各式動畫 -->
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
    if(empty(@$_POST['npw']) == false && empty(@$_POST['npw2']) == false){// 確認密碼是否都有填
        if(@$_POST['npw'] == @$_POST['npw2']){                  //兩次密碼484一樣
			$hashed_pw = md5(@$_POST['npw']);					//hashing pw
            $sth = $dbh->prepare('update  users set pw = ? where id = ?');//修改密碼
            $sth->execute(array($hashed_pw,$_SESSION['login']));
            //告知成功修改並重新倒回登入頁面
            echo "<script>alert('Password has been modified!')</script>";
            echo "<script type='text/javascript'>";
                echo "window.location.href='index.php'";
            echo "</script>";  
        }
        //發出警告訊息
        else echo "<script>alert('The passwords you typed do not match. Please retype the new password.')</script>";
    }
?> 