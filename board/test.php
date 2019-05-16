<?php
    session_start();
?>
<form method="POST">
ID:<input type = "text" name = "id"><br>
PW:<input type = "password" name = "pw"><br>
<input type = "submit" value ="login">
</form>
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
        header("location:who.php");
    }
    else {
        $_SESSION['login'] = '';
        echo "some error";
    }
}