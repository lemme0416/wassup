<?php
	session_start();
	if(!isset($_SESSION['login'])){
		header("Location: index.php");
	}
	else{
		if(isset($_GET['list_name'])){
			$list_name = $_GET['list_name'];
			require_once('login.php');
			$dsn = 'mysql:host=localhost;dbname=wassup';
			$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
			$inst = 'drop table '.$_SESSION['login'].'_list_'.$list_name.';';
			$sth = $dbh->prepare($inst);
			$sth->execute();
			$inst = 'delete from '.$_SESSION['login'].'_list where list_name='."'$list_name'".';';
			$sth = $dbh->prepare($inst);
			$sth->execute();
		}
		header("Location: red.php");
	}

?>