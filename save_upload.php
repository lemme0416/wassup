﻿<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<?PHP
	session_start();
	//確認是否登入
	if(isset($_SESSION['login'])==false){
		header("Location: index.php");
	}
	if(!empty($_FILES['uploaded_file'])){
		//確認檔案類型，若錯誤則回傳錯誤訊息
		if($_FILES['uploaded_file']['type']!='audio/mp3' && $_FILES['uploaded_file']['type']!='audio/mpeg'){
			header("Location: upload.php?value=wrong_type_".$_FILES['uploaded_file']['type']); 
		}
		else{
			$path = "music/";
			//取得檔名
			$des = $path . basename( $_FILES['uploaded_file']['name']);
			//移動檔案到 $des
			if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $des)) {
				//成功訊息
				$return_value = 'success';
				$file_name = basename( $_FILES['uploaded_file']['name'], '.mp3');
				console_log($file_name);
				require_once('login.php');
				$dsn = 'mysql:host=localhost;dbname=wassup';
				$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
				//將音樂檔名存到music table中,資料包括檔名以及分類
				$sth=$dbh->prepare('insert into music(name, language) values(? , ?)');
				if($_POST['language']=='asia') $num = 1;
				else if($_POST['language']=='america') $num = 0;
				$sth->execute(array($file_name, $num));
			} else{
				//錯誤訊息
				$return_value = 'error';
			}
			//返回上傳頁面以及訊息
			$inst = "Location: upload.php?value=".$return_value;
			header($inst); 			
		}
	}
	else{
		//返回上傳頁面以及訊息
		$inst = "Location: upload.php?value=empty_file";
		header($inst);
	}
?>