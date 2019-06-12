<?php
	session_start();
	//確認是否登入
	if(!isset($_SESSION['login'])){
		header("Location: index.php");
	}
	else{
		if(isset($_POST['list_name'])){
			require_once('login.php');
			$dsn = 'mysql:host=localhost;dbname=wassup';
			$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
			//建立播放清單
			$inst = 'create table if not exists '.$_SESSION['login'].'_list_'.$_POST['list_name'].' (id INT(11), name VARCHAR(100), CONSTRAINT song_unique UNIQUE (id, name));';
			echo $inst;
			$sth = $dbh->prepare($inst);
			$sth->execute();
			//在清單總Table中加入新Table的資料
			$inst = 'insert into '.$_SESSION['login'].'_list(list_name) values (?);';
			$sth = $dbh->prepare($inst);
			$sth->execute(array($_POST['list_name']));
			//重新整理右方頁面，使更新資料能夠及時顯示
			echo "<script> parent.frames[2].location.reload(true) </script>";
		}
		//回到原本的列表
		echo "<script> window.location = 'left.php' </script>";
	}
?>