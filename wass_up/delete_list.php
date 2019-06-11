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
			$inst = 'DROP TABLE '.$_SESSION['login'].'_list_'.$list_name.';';
			echo $inst;
			$sth = $dbh->prepare($inst);
			$sth->execute();
			$inst = 'delete from '.$_SESSION['login'].'_list where list_name='."'$list_name'".';';
			echo $inst;
			$sth = $dbh->prepare($inst);
			$sth->execute();
			echo '<script> refresh(); </script>';
		}
		//header("Location: red.php");
	}
?>
<script>
	function refresh(){
		parent.frames[1].location = "left.php";
	}
</script>