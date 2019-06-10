﻿<?php
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
			echo '<p>Hello, '.$row['name'].'</p>';
		}
	?>
	</div>
	<div onclick="jump('modify_pw.php')">
		<p onclick="jump('modify_pw.php')">Modify Password</p>
	</div>
	<div onclick="jump('upload.php')">
		<p>上傳音樂</p>
	</div>
	<div onclick="jump('red.php')">
		<p>排行榜</p>
	</div>
	<?php
		$inst = 'select * from '.$_SESSION['login'].'_list;';
		$sth = $dbh->prepare($inst);
		$sth->execute();
		while($row=$sth->fetch(PDO::FETCH_ASSOC)){
			echo '<div onclick="jump("'.'list.php?list_name='.$list_name.'")">';
			echo '<p>'.$row['list_name'].'</p>';
			echo '</div>';	
		}
	?>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="show_form()">
		<p>新增清單</p>
	</div>
	<form method = "POST" hidden = "true" action="add_list.php" id="hidden_form" style="margin:0px 0px 0px 10px">
		<input type="text" required="true" name="list_name">
		<input type="submit" value="新增">
	</form>

    <script>
		// function color_deep(x) {
		// 	x.style.backgroundColor = 'DimGray';
		// }
		// function color_shallow(x) {
		// 	x.style.backgroundColor = 'gray';
		// }
		function jump(x){
			parent.frames[2].location = x;
		}
		function show_form(){
			var hid = document.getElementById("hidden_form");
			hid.hidden = !(hid.hidden);
		}
		function toggleSidebar(){
			document.getElementById("sidebar").classList.toggle('active');
		}
	</script>

</body>
</html>