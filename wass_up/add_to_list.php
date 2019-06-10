<?php
	session_start();
	if(isset($_GET['song_name'])){
		require_once('login.php');
		$dsn = 'mysql:host=localhost;dbname=wassup';
		$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
		$song_name = $_GET['song_name'];
		$inst = 'insert into '.$_SESSION['login'].'_list_'.$_POST['list_name'].' values('."'$song_name'".');';
		$sth = $dbh->prepare($inst);
		$sth->execute();
		header("Location: red.php");
	}
?>