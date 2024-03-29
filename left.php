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
	<!-- div for 'hello, name' -->
	<div class="options_div">
	<?php
		require_once('login.php');
		$dsn = 'mysql:host=localhost;dbname=wassup';
		$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
		$name = $dbh->prepare('select * from users where id = ? ;');
		$name->execute(array($_SESSION['login']));
		while($row=$name->fetch(PDO::FETCH_ASSOC)){
			echo '<p class="intro">Hello, '.htmlentities($row['name']).'</p>';
		}
	?>
	</div>
	<!-- div for log out -->
	<div class="options_div" onclick = "javascript:parent.location.href='index.php'">
		<p class="options" >登出</p>
	</div>
	<!-- div for modify password -->
	<div class="options_div" onclick="jump('modify_pw.php')">
		<p class="options" onclick="jump('modify_pw.php')">修改密碼</p>
	</div>
	<!-- div for upload -->
	<div class="options_div" onclick="jump('upload.php')">
		<p class="options">上傳音樂</p>
	</div>
	<!-- div for 亞洲排行榜 -->
	<div class="options_div" onclick="jump('red.php?language=1')">
		<p class="options">亞洲排行榜</p>
	</div>
	<!-- div for 歐美排行榜 -->
	<div class="options_div" onclick="jump('red.php?language=0')">
		<p class="options">歐美排行榜</p>
	</div>
	<!-- div for add list -->
	<div class="options_div" onclick="input_box()">
		<p class="options">新增清單</p>
	</div>
	<!-- div for pop out add list input -->
	<div id="modal-wrapper" class="modal">
		<form class="modal-content animate" method = "POST" action="add_list.php" >
			<div onclick="document.getElementById('modal-wrapper').style.display='none'" class="close">&times;</div>
			<h2>Add new list!</h2>
			<input type="text" id="input" required="true" name="list_name" placeholder="Playlist Name"><br>
			<input type="submit" value="Add">
		</form>
	</div>

	<?php
		$inst = 'select * from '.$_SESSION['login'].'_list;';
		$sth = $dbh->prepare($inst);
		$sth->execute();
		while($row=$sth->fetch(PDO::FETCH_ASSOC)){
			$list_name = $row['list_name'];
			$list_url = 'list.php?list_name='.$list_name;
			echo '<div class="options_div" onclick="jump('."'$list_url'".')">';
			echo '<img class="options_img" width="50px" src="list.png">';
			echo '<p class="options">'.htmlentities($list_name).'</p>';
			echo '</div>';	
		}
	?>
</body>
</html>