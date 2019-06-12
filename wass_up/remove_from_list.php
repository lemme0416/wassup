<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<?php
	session_start();
	//確認是否登入
	if(!isset($_SESSION['login'])){
		header("index.php");
	}
	else{
		if(isset($_GET['song_id'])){
			require_once('login.php');
			$dsn = 'mysql:host=localhost;dbname=wassup';
			$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
			$list_name = $_GET['list_name'];
			$song_id = $_GET['song_id'];
			//從播放清單中刪除歌曲
			$inst = 'delete from '.$_SESSION['login'].'_list_'.$list_name.' where id='.$song_id .';';
			$sth = $dbh->prepare($inst);
			$sth->execute();
			//回到原本的清單
			$destination = 'Location: list.php?list_name='.$list_name;
		}
		header($destination);
	}
?>