<?php
    header("Content-Type: text/html; charset=utf-8");
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>WassUp!</title>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="index_css.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <script src="index_js.js"></script>
    </head>
    <body>
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
        <div class="box">
            <form method = "POST" >
                <input type = "text" name = "id" required="TRUE" placeholder="E-mail Address"><br>
                <input type = "password" name = "pw" required="TRUE" placeholder="PASSWORD"><br>
                <input type = "submit" value = "SIGN IN">
                <input type = "button" value = "SIGN UP" onclick = "javascript:location.href='createaccount.php'">
                <a href = "forgetpw.php">Forget Password?</a>
            </form>
        </div>
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
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require_once('login.php');
        $dsn = 'mysql:host=localhost;dbname=wassup';
        $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
        $sth = $dbh->prepare('select * from users where id = ? ;');
        $sth->execute(array($_POST['id']));
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['id'] == $_POST['id']){     // Whether have this id
            if($result['pw'] == $_POST['pw']){ // Passwrord correct or not
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
                echo "<script>alert('Wrong Password!')</script>";
            }
        }
        else{
            $_SESSION['login'] = '';
            echo "<script>alert('Cannot find this username!')</script>";
        }

    }
?>