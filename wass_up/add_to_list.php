<?php
	session_start();
	if(isset($_GET['song_name'])){
		require_once('login.php');
		$dsn = 'mysql:host=localhost;dbname=wassup';
		$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
		$song_name = $_GET['song_name'];
		$song_id = $_GET['song_id'];
		//將歌曲名稱加入指定播放清單
		$inst = 'insert into '.$_SESSION['login'].'_list_'.$_POST['list_name'].' values('.$song_id.','."'$song_name'".');';
		$sth = $dbh->prepare($inst);
		$sth->execute();
		//此變數儲存上一頁的網址，作用為回到上一頁
		header('Location: '.$_SESSION['last']);
	}
?>