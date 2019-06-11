<?php
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
			margin: 3px 5px;
			line-height: this.height;
		}
		body{
			background-color: lightblue;
			margin: 0px;
		}
		p{
			display: inline-block;
			text-align: center;
			color: white;
			margin-left: 5px;
		}
		form{
			display: inline-block;
			float: right;
		}
		select{
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
	while($col=$sth1->fetch(PDO::FETCH_ASSOC)){
		array_push($arr, $col['list_name']);
	}
    $sth2 = $dbh->prepare('select * from music;');
    $sth2->execute();
	while($row=$sth2->fetch(PDO::FETCH_ASSOC)){
		$song_name = $row['name'];
		$song_id = $row['id'];
		echo '<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('."'$song_id'".')">
		';
		echo '<p>'.$song_name.'</p>';
		echo '<select name="list_name" onclick="bubble(event)" form="'.$song_id.'">';
		foreach($arr as $value){
			echo '<option value='."'$value'".'>'.$value.'</option>';
		}
		echo '</select>';
		echo '<form method="POST" onclick="bubble(event)" id="'.$song_id.'"action="add_to_list.php?song_name='.$song_name.'&song_id='.$song_id.'"><input type="submit" value="add to list"></form>';
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