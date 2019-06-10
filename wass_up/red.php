﻿<?php
	session_start();
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>music</title>
	<style>
		div{
			overflow: hidden;
			background-color: DarkSlateGray;
			border: 2px solid white;
			margin: 2px 2px;
		}
		body{
			background-color: lightblue;
			margin: 0px;
		}
		p{
			display: inline-block;
			text-align: center;
			color: white;
		}
		form{
			display: inline-block;
			float: right;
		}
	</style>
</head>
<body>

<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
	$inst = 'select * from '.$_SESSION['login'].'_list;';
	$sth1 = $dbh->prepare($inst);
    $sth1->execute();
	$arr = array();
	$i = 0;
	while($col=$sth1->fetch(PDO::FETCH_ASSOC)){
		$arr[$i] = $col;
		$i++;
	}
    $sth2 = $dbh->prepare('select * from music;');
    $sth2->execute();
	while($row=$sth2->fetch(PDO::FETCH_ASSOC)){
		$song_name = $row['name'];
		echo '<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('."'$song_name'".')">
		';
		echo '<p>'.$song_name.'</p>';
		echo '<form><select name='."'$song_name'".'>';
		foreach($arr as $value){
			echo '<option value='."'$value'".'>'.$value.'</option>';
		}
		echo" </select></form>
		";
		echo"</div>
		";
	}
?>
<script>
	function color_deep(x) {
		x.style.backgroundColor = 'black';
	}
	function color_shallow(x) {
		x.style.backgroundColor = 'DarkSlateGray ';
	}
	function jump(x){
		var address = "music2.php?name=" + x;
		parent.frames[3].location = address;
	}
</script>
</body>
</html>