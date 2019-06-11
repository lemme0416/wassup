<?php
session_start();
?>
<!DOCTYPE html>
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
		<div onclick="document.getElementById('modal-wrapper').style.display='block'" style="width: 200px; position: absolute; top: 50%; left: 50%>
			<p class="options">新增清單</p>
		</div>
		<div id="modal-wrapper" class="modal">
			<form method = "POST" hidden = "true" action="add_list.php" class="modal-content animate">
				<div class="container">
					<input type="text" required="true" name="list_name">
					<input type="submit" value="Add">
				</div>
			</form>	
		</div>
		<script>
		// If user clicks anywhere outside of the modal, Modal will close

		var modal = document.getElementById('modal-wrapper');
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		</script>
		<?php
			$inst = 'select * from '.$_SESSION['login'].'_list;';
			$sth = $dbh->prepare($inst);
			$sth->execute();
			while($row=$sth->fetch(PDO::FETCH_ASSOC)){
				$list_name = $row['list_name'];
				$list_url = 'list.php?list_name='.$list_name;
				echo '<div onclick="jump('."'$list_url'".')">';
				echo '<p class="options">'.$list_name.'</p>';
				echo '</div>';	
			}
		?>
	</body>
</html>