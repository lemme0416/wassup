<?php
    header("Content-Type: text/html; charset=utf-8");
    session_start();
?>
<html>
<style>
    #a {
        width:300px; 
        height:300px; 
        /*margin:30px auto 0;*/ 
        text-align:left; 
        font-size :40fpx;
        position : absolute;
        left :50%;
        top :50%;
        margin-top:-140px;
        margin-left:-150px;
        color: white;
    }
    #b{
        width:300px; 
        height:300px; 
        /*margin:30px auto 0;*/ 
        text-align:left; 
        font-size :40fpx;
        position : absolute;
        left :50%;
        top :50%;
        margin-top:0px;
        margin-left:-150px;
        color:white;
    
        
    }
    #p{
        text-align: center;
        font-size : 10vw;
        font-weight: bold;
        margin-block-start:-1em;
        margin-block-end:auto;
        margin-inline-start:-1em;
        margin-inline-end:-1em;
    }
    a:link{
        color:white;
    }
    a:visited{
        color:#66ccff;
    }
    
</style>
<body background = "img103.png">
<div id = "a">
    <h1 id = "p">留言板</h1>
    <form method = "POST" >
    account  :
    <input type = "text" name = "id" style ="width 100px;height:30px" value = "admin"><br>
    password:
    <input type = "password" name = "pw" style ="width 100px;height:30px" value = "admin"><br>
    <input type = "submit" value = "sign in">
    <input type = "button" value = "sign up" onclick = "javascript:location.href='createaccount.php'">
    <form>
</div>
<div id = "b">
    <a href = "forgetpw.php">forget password</a>
</div>
</body>
</html>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require_once('login.php');
        $dsn = 'mysql:host=localhost;dbname=s106062131';
        $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
        $sth = $dbh->prepare('select count(*) as r from users where id = ? and pw = ? ;');
        $sth->execute(array($_POST['id'],$_POST['pw']));
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['r'] == 1){
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
            echo "<script>alert('something wrong')</script>";
            $error = "something wrong";
            echo $error;
        }
    }
