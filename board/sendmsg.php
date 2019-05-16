<?php
session_start();
$nkn = $gender = "";
require_once('login.php');
$dsn = 'mysql:host=localhost;dbname=s106062131';
$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
$sth = $dbh->prepare('select * from users where id = ? ;');
$sth->execute(array($_SESSION['login']));
while ($row = $sth->fetch()){
    $nkn = $row['nickname'];
    $gender = $row['gender'];
    echo "Hello ".$nkn."! Your gender is ".$gender;    
}

//echo "you are ".$_SESSION['login']; 
?>
<html>
<body background = "sd.jpg" style = "color :white">
<form method="POST">
<p><textarea name="message" rows="8" cols="52"></textarea></p>
<p><input type="submit" value="送出留言"> <input type="reset" value="清除留言"><input type = "button" value = "回上頁"  onclick="history.back()"></p>
</form>
<script>
</body>

</script>
</html>
<?php
    date_default_timezone_set('Asia/Taipei');
    $datetime = date ("Y-m-d H:i:s"); 
    $sth = $dbh->prepare('insert into test (id,msg,time,gender) values (?,?,?,?) ;');
    echo $datetime;
    $sth->execute(array($nkn,$_POST['message'],$datetime,$gender));

?> 