<?php
	session_start();
	if(!isset($_SESSION['login'])){
		header("Location: index.php");
	}
?>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
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
			margin-left: 5px;
			color: white;
		}
		form.a{
			display: inline-block;
			margin: 14.6px 2.5px 14.6px 2.5px;
			float: right;
		}
		form.b{
			margin: 7px 45vw;
		}
		select{
			display: inline-block;
			margin: 17.6px 2.5px 17.6px 2.5px;
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
	while($col=$sth1->fetch(PDO::FETCH_ASSOC)){
		array_push($arr, $col['list_name']);
	}
	$list_name = $_GET['list_name'];
	$inst = 'select * from '.$_SESSION['login'].'_list_'.$list_name;
    $sth2 = $dbh->prepare($inst);
    $sth2->execute();
	echo '<form method="GET" class="b" action="delete_list.php?list_name='.$list_name.'">';
	echo '<input type="submit" value="delete list"></form>';
	while($row=$sth2->fetch(PDO::FETCH_ASSOC)){
		$song_name = $row['name'];
		$song_id = $row['id'];
		echo '<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('."'$song_id'".')">
		';
		echo '<p>'.$song_name.'</p>';
		echo '<form method="POST" class="a" onclick="bubble(event)" action="remove_from_list.php?list_name='.$list_name.'&song_id='.$song_id.'"><input type="submit" value="remove from list"></form>';
		echo '<form method="POST" class="a" onclick="bubble(event)" id="'.$song_id.'"action="add_to_list.php?song_name='.$song_name.'&song_id='.$song_id.'"><input type="submit" value="add to list"></form>';
		echo '<select name="list_name" onclick="bubble(event)" form="'.$song_id.'">';
		foreach($arr as $value){
			echo '<option value='."'$value'".'>'.$value.'</option>';
		}
		echo '</select>';
		echo '</div>';
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
		var address = "music2.php?id=" + x;
		var obj = {"table":"music", "id":x-1};
		parent.frames[3].play_music(obj);
	}
	function bubble(event){
		event.cancelBubble = true;
	}
</script>
</body>
</html>