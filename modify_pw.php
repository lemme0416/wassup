<?php
    header("Content-Type: text/html; charset=utf-8");
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="css/modify_pw.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>    
    </head>
    <body>
        <!-- 動畫 -->
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
        <div id="title">
            <ul class="text-animation hidden">
                <li>M</li>
                <li>o</li>
                <li>d</li>
                <li>i</li>
                <li>f</li>
                <li>y</li>
                <li>!</li>
            </ul>
            <!-- 輸入表格 -->
            <div class="box">
                <form method="POST">
                    <input type = "password" name = "npw" required = "TRUE" placeholder="New Password"><br>
                    <input type = "password" name = "npw2" required = "TRUE" placeholder="Enter New Password Again"><br>
                    <input type = "submit" value ="Confirm">
                </form>
            </div>
            <!-- 動畫 -->
            <script type="text/javascript">
                $(function(){
                    setTimeout(function(){
                        $('.text-animation').removeClass('hidden');
                    }, 500);
                });
            </script>
        </div>
    </body>
</html>
<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    if(empty(@$_POST['npw']) == false && empty(@$_POST['npw2']) == false){//判斷是否為空
        if(@$_POST['npw'] == @$_POST['npw2']){              //判斷兩次密碼是否一樣
			$hashed_pw = md5(@$_POST['npw']);				//hashing pw
            $sth = $dbh->prepare('update  users set pw = ? where id = ?'); //修改密碼
            $sth->execute(array($hashed_pw,$_SESSION['login']));
            //告知成功修改並重新倒回登入頁面
            echo "<script>alert('Password has been modified!')</script>";
            echo "<script type='text/javascript'>";
                echo "window.parent.frames[2].location.href='jsGame/index.php'";
            echo "</script>";  
        }
        //發出警告訊息
        else echo "<script>alert('The passwords you typed do not match. Please retype the new password.')</script>";
    }  
?> 