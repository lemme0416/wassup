<?php
	session_start();
	if(isset($_GET['song_name'])){
		require_once('login.php');
		$dsn = 'mysql:host=localhost;dbname=wassup';
		$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
		$song_name = $_GET['song_name'];
		$song_id = $_GET['song_id'];
		$inst = 'delete from '.$_SESSION['login'].'_list_'.$_POST['list_name'].' where id='.$song_id ;
		$sth = $dbh->prepare($inst);
		$sth->execute();
		$destination = 'Location: list.php?'.$_POST['list_name'];
		header($destination);
	}
?>