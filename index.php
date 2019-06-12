<?php
    header("Content-Type: text/html; charset=utf-8");
    if(isset($_SESSION['login']))unset($_SESSION['login']);                 // if log out clear session         
    session_start();                                                       
?>
<!DOCTYPE html>
<html>
    <head>
        <title>WassUp!</title>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="css/index.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <script src="js/index.js"></script>
    </head>
    <body>
        <!-- background -->
        <img src="https://imgur.com/OCPuJWd.png" id="weed_img" onclick="weed()" >
        <img src="https://imgur.com/OCPuJWd.png">
        <img src="https://imgur.com/OCPuJWd.png">
        <img src="https://imgur.com/OCPuJWd.png">
        <img src="https://imgur.com/OCPuJWd.png">
        
        <img src="https://imgur.com/OCPuJWd.png">
        <img src="https://imgur.com/OCPuJWd.png">
        <img src="https://imgur.com/OCPuJWd.png">
        <img src="https://imgur.com/OCPuJWd.png">
        <img src="https://imgur.com/OCPuJWd.png">
        
        <img src="https://imgur.com/OCPuJWd.png">
        <img src="https://imgur.com/OCPuJWd.png">

        <ul class="text-animation hidden">
            <li>W</li>
            <li>a</li>
            <li>s</li>
            <li>s</li>
            <li>U</li>
            <li>p</li>
            <li>!</li>
        </ul>
        <!-- above background -->
        <!-- below sign in block -->
        <div class="box">
            <form method = "POST" >
                <input type = "text" name = "id" required="TRUE" placeholder="Your ID">                 
                <input type = "password" name = "pw" required="TRUE" placeholder="Password"><br>
                <input type = "submit" value = "SIGN IN">                                                               
                <input type = "button" value = "SIGN UP" onclick = "javascript:location.href='create_account.php'">     
                <a href = "forget_pw.php">Forget Password?</a>
            </form>
        </div>
        <script type="text/javascript">
        //wassup動畫
            $(function(){
                setTimeout(function(){
                    $('.text-animation').removeClass('hidden');
                }, 500);
            });
        </script>
        <!-- 背景音樂 -->
        <audio id="music"src="music/Dr. Dre - The Next Episode ft. Snoop Dogg, Kurupt, Nate Dogg.mp3" loop style="visibility: hidden"></audio>
    </body>
</html>
<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){                   //防止別人用GET或其他模式登入
        require_once('login.php');                              //登入的資料庫的帳密  
        $dsn = 'mysql:host=localhost;dbname=wassup';            //資料庫名字與使用方法
        $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);       //登入
        $sth = $dbh->prepare('select * from users where id = ? ;');     //確認能否登入
        $sth->execute(array($_POST['id']));                     // 放入帳號攔的資料
        $result = $sth->fetch(PDO::FETCH_ASSOC);                //獲取資料
        if($result['id'] == $_POST['id']){                      // Whether have this id
			$hashed_pw = md5($_POST['pw']);						// hashing pw
            if($result['pw'] == $hashed_pw){                  // Passwrord correct or not
                $_SESSION['login'] = $_POST['id'];              //紀錄登入所使用的id
                if($_POST['id'] == 'admin'){                    //是否為管理者帳戶
                    $url = "home.php";                          //進入後要進去的網站
                }
                else $url = "home.php";
                echo "<script type='text/javascript'>";
                    echo "window.location.href='$url'";
                echo "</script>";                 
            }
            else {
                $_SESSION['login'] = '';
                echo "<script>alert('Wrong Password!')</script>";
            }
        }
        else{
            $_SESSION['login'] = '';
            echo "<script>alert('Cannot find this username!')</script>";
        }

    }
?>