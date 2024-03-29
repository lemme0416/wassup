﻿<?php
	session_start();
	//確認是否登入
	if(!isset($_SESSION['login'])){
		header("Location: index.php");
	}
?>
<html>
<head>
	<link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
	
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	
	<link rel="stylesheet" href="css/red.css">
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	
	<script src="js/red.js"></script>
</head>
<body>

<?php
    require_once('login.php');
	//記住當前位置，用於將音樂加入清單後回到原頁面
	$_SESSION['last'] = 'red.php?language='.$_GET['language'];
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
	//將用戶所有清單取出
	$inst = 'select * from '.$_SESSION['login'].'_list;';
	$sth1 = $dbh->prepare($inst);
    $sth1->execute();
	$arr = array();
	//將所有清單放入陣列中
	while($col=$sth1->fetch(PDO::FETCH_ASSOC)){
		array_push($arr, $col['list_name']);
	}
	//根據$_GET['language']取出亞洲或歐美種類的音樂
    $sth2 = $dbh->prepare('select * from music where language = ?;');
    $sth2->execute(array($_GET['language']));
	while($row=$sth2->fetch(PDO::FETCH_ASSOC)){
		$song_name = $row['name'];
		$song_id = $row['id'];
		echo '<div>';
		//為每首音樂創建icon、加入清單的button
		echo '<img src="https://i.imgur.com/T1iuPh7.png" onmouseover="play_black(this)" onmouseout="play_white(this)" onclick="jump('.$song_id.','."'music'".','.$_GET['language'].')">';
		echo '<p>'.htmlentities($song_name).'</p>';
		echo '<form method="POST" onclick="bubble(event)" id="'.$song_id.'" action="add_to_list.php?song_name='.htmlentities($song_name).'&song_id='.$song_id.'"><input type="submit" value="+" title="Add to the list"></form>';
		echo '<select name="list_name" onclick="bubble(event)" form="'.$song_id.'">';
		echo '<option value="0">Choose a list</option>';
		foreach($arr as $value){
			$html_value = htmlentities($value);
			echo '<option value='."'$html_value'".'>'.$html_value.'</option>';
		}
		echo '</select>';
		echo '</div>';
	}
?>
</body>
</html>