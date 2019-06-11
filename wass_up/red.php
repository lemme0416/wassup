<?php
	session_start();
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
	
	<script src="js/left.js"></script></head>
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
		echo '<div>
		';
		echo '<img src="https://i.imgur.com/CY4HN75.png" onmouseover="play_black(this)" onmouseout="play_white(this)" onclick="jump('."'$song_id'".')">';
		echo '<p>'.$song_name.'</p>';
		echo '<form method="POST" onclick="bubble(event)" id="'.$song_id.'" action="add_to_list.php?song_name='.$song_name.'&song_id='.$song_id.'"><input type="submit" value="add to list"></form>';
		echo '<select name="list_name" onclick="bubble(event)" form="'.$song_id.'">';
		foreach($arr as $value){
			echo '<option value='."'$value'".'>'.$value.'</option>';
		}
		echo '</select>';
		echo '</div>';
	}
?>
<script>
	function play_black(x){
		x.src="https://i.imgur.com/POXP1rs.png";
	}
	function play_white(x){
		x.src="https://i.imgur.com/CY4HN75.png";
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