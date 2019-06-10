<?php
session_start();
?>
<html>
<head>
	<link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
	
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	
	<link rel="stylesheet" href="css/left.css">
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	
	<script src="js/left.js"></script>
</head>
<body>
	<div>
	<?php
		require_once('login.php');
		$dsn = 'mysql:host=localhost;dbname=wassup';
		$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
		$name = $dbh->prepare('select * from users where id = ? ;');
		$name->execute(array($_SESSION['login']));
		while($row=$name->fetch(PDO::FETCH_ASSOC)){
			echo '<p class="intro">Hello, '.$row['name'].'</p>';
		}
	?>
	</div>
	<div onclick="jump('modify_pw.php')">
		<p class="options" onclick="jump('modify_pw.php')">Modify Password</p>
	</div>
	<div onclick="jump('upload.php')">
		<p class="options">上傳音樂</p>
	</div>
	<div onclick="jump('red.php')">
		<p class="options">排行榜</p>
	</div>
	<?php
		$inst = 'select * from '.$_SESSION['login'].'_list;';
		$sth = $dbh->prepare($inst);
		$sth->execute();
		while($row=$sth->fetch(PDO::FETCH_ASSOC)){
			$list_name = $row['list_name'];
			echo '<div onclick="jump('.'"list.php?list_name='.$list_name.'")'.'">';
			$list_url = 'list.php?list_name='.$list_name;
			echo '<p class="options">'.$list_name.'</p>';
			echo '</div>';	
		}
	?>
	<div onclick="show_form()">
		<p class="options">新增清單</p>
	</div>
	<form method = "POST" hidden = "true" action="add_list.php" id="hidden_form" style="margin:0px 0px 0px 10px">
		<input type="text" required="true" name="list_name">
		<input type="submit" value="新增">
	</form>
</body>
</html>