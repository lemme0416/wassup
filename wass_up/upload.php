<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
		
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
		
		<link rel="stylesheet" href="css/upload.css">
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>   
	</head>
	<?php
		session_start();
		//check whether the visitor is a member
		if(isset($_SESSION['login'])==false){
			header("Location: index.php");
		}
		if(isset($_GET['value'])){
			if($_GET['value']=='wrong_type'){
				echo "<script>alert('Wrong type!')</script>";
			}
			else if($_GET['value']=='error'){
				echo "<script>alert('Fail to upload!')</script>";
			}
			else if($_GET['value']=='success'){
				echo "<script>alert('Uploaded!')</script>";
			}
		}
	?>

	<body>
		<section class="wrapper">
			<div id="stars"></div>
			<div id="stars2"></div>
			<div id="stars3"></div>
			<div id="title">
				<ul class="text-animation hidden">
                    <li>U</li>
                    <li>p</li>
                    <li>l</li>
                    <li>o</li>
                    <li>a</li>
                    <li>d</li>
                    <li>!</li>
				</ul>
				<div class="box">
					<form action="save_upload.php"  method="post" enctype="multipart/form-data">
						Select music to upload:
						<input type="file" name="uploaded_file" accept=".mp3">
						<input type="submit" value="Upload">
					</form>
				</div>
			</div>
		</section>
	</body>
</html>