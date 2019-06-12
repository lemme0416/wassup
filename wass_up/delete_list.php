<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

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
			//刪除指定Table
			$inst = 'DROP TABLE '.$_SESSION['login'].'_list_'.$list_name.';';
			$sth = $dbh->prepare($inst);
			$sth->execute();
			//從清單總Table中刪除指定列表的資料
			$inst = 'delete from '.$_SESSION['login'].'_list where list_name='."'$list_name'".';';
			$sth = $dbh->prepare($inst);
			$sth->execute();
			//重新整理左方頁面，使更新資料能即時顯示
			echo "<script> parent.frames[1].location.reload(true) </script>";
		}
		//回到亞洲排行榜
		echo "<script> window.location='red.php?language=1' </script>";
	}
?>