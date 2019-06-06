<?php
session_start();
#if($_SESSION['login'] == 'admin'){
?>
<body background = "pw.jpg">
<form method="POST">
ID:<input type = "text" name = "id"><br>
PW:<input type = "password" name = "pw"><br>
nickname:<input type ="text" name = "nkn"><br>
gender:<input type = "text" name = "sex"><br>
security word<input type = "text" name = "security"><br>
 <!-- 案submit 創帳號 案return回首頁 -->
<input type = "submit" value ="create"><input type = "button" value = "return" onclick = "javascript:location.href='index.php'"> 
</form>
</body>
<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    $sth = $dbh->prepare('insert into users (id,pw,name,gender,problem) values (?,?,?,?,?) ;');
    $sth->execute(array(@$_POST['id'],@$_POST['pw'],@$_POST['nkn'],@$_POST['sex'],@$_POST['security']));
?> 