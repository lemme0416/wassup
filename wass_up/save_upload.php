<?PHP
	session_start();
	//check whether the visitor is a member
	if(isset($_SESSION['login'])==false){
		header("Location: index.php");
	}
	if(!empty($_FILES['uploaded_file'])){
		if($_FILES['uploaded_file']['type']!='audio/mp3'){
			header("Location: upload.php?value=wrong_type"); 
		}
		else{
			$path = "music/";
			$des = $path . basename( $_FILES['uploaded_file']['name']);
			if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $des)) {
				$return_value = 'success';
				$file_name = basename( $_FILES['uploaded_file']['name'], '.mp3');
				require_once('login.php');
				$dsn = 'mysql:host=localhost;dbname=wassup';
				$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
				$sth=$dbh->prepare('insert into music(name,music) values(:name,:music)');
				$sth->bindParam(':name', $file_name);
				$sth->bindParam(':music',$file_name);
				$sth->execute();
			} else{
				$return_value = 'error';
			}
			$inst = "Location: upload.php?value=".$return_value;
			header($inst); 			
		}

	}
?>