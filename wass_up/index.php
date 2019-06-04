<?php
    header("Content-Type: text/html; charset=utf-8");
    session_start();
?>
<html>
    <head>
        <title>WassUp!</title>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="index_css.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <script src="index_js.js"></script>
    </head>
    <body>
        <img src="https://imgur.com/OCPuJWd.png" id="weed_img" onclick="weed(this)" >
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
        <form class="box" method = "POST" >
            <input type = "text" name = "id" required="TRUE" placeholder="USERNAME"><br>
            <input type = "password" name = "pw" required="TRUE" placeholder="PASSWORD"><br>
            <input type = "submit" value = "SIGN IN">
            <input type = "button" value = "SIGN UP" onclick = "javascript:location.href='createaccount.php'">
            <a href = "forgetpw.php">Forget Password?</a>
        </form>
        <br>
        <?php if($error_flag){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 密碼錯誤！
            </div>
        <?php }?>
        
        <?php if($notfound_flag){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 未找到本使用者！
            </div>
          <?php }?>
        <script type="text/javascript">
            $(function(){
                setTimeout(function(){
                    $('.text-animation').removeClass('hidden');
                }, 500);
            });
        </script>
        <audio id="music"src="Dr. Dre - The Next Episode ft. Snoop Dogg, Kurupt, Nate Dogg.mp3" loop style="visibility: hidden"></audio>
    </body>
</html>
<?php
    $error_flag = FALSE;
    $notfound_flag = FALSE;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require_once('login.php');
        $dsn = 'mysql:host=localhost;dbname=wassup';
        $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
        $sth = $dbh->prepare('select * from users where id = ? ;');
        $sth->execute(array($_POST['id']));
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['id'] == $_POST['id']){ // whether have this id
            if($result['pw'] == $_POST['pw']){ // passwrord correct or not
                $_SESSION['login'] = $_POST['id'];
                if($_POST['id'] == 'admin'){
                    $url = "home.html";
                }
                else $url = "home.html";
                echo "<script type='text/javascript'>";
                    echo "window.location.href='$url'";
                echo "</script>";                 
            }
            else {
                $_SESSION['login'] = '';
                $error_flag = TRUE;
                // echo "<script>alert('wrong pw?')</script>";

            }
        }
        else{
            $_SESSION['login'] = '';
            $notfound_flag = TRUE;

            // echo "<script>alert('no this id?')</script>";
        }

    }
?>