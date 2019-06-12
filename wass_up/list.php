<?php
	session_start();
	if(!isset($_SESSION['login'])){
		header("Location: index.php");
	}
?>
<html>
	<head>
		<link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
		
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
		
		<link rel="stylesheet" href="css/list.css">
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		
		<script src="js/list.js"></script>	</head>
	<body>

	<?php
		require_once('login.php');
		$_SESSION['last'] = 'list.php?list_name='.$_GET['list_name'];
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
		echo '<form method="POST" class="b" action="delete_list.php?list_name='.$list_name.'">';
		echo '<input type="submit" value="delete list" onclick="alert_success()"></form>';
		while($row=$sth2->fetch(PDO::FETCH_ASSOC)){
			$song_name = $row['name'];
			$song_id = $row['id'];
			echo '<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('."'$song_id'".')">
			';
			echo '<p>'.$song_name.'</p>';
			echo '<form method="POST" class="a" onclick="bubble(event)" action="remove_from_list.php?list_name='.$list_name.'&song_id='.$song_id.'"><input type="submit" value="-"></form>';
			echo '<form method="POST" class="a" onclick="bubble(event)" id="'.$song_id.'"action="add_to_list.php?song_name='.$song_name.'&song_id='.$song_id.'"><input type="submit" value="+"></form>';
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
		function alert_success() {
			alert('Delete SUCCESS!');
		}
	</script>
	</body>
</html>