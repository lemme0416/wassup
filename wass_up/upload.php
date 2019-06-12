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
					<h2>Select music to upload :</h2>
					<input type="file" name="uploaded_file" id="real-file" hidden="hidden" accept=".mp3">
					<button type="button" id="custom-button">CHOOSE A FILE</button>
					<span id="custom-text">No file chosen, yet.</span>
					<a class="styles">Style  :  </a>
                	<input type = "radio" name = "language" required = "true" value="asia"><a class="options">Asia</a>
                	<input type = "radio" name = "language" value="america"><a class="options">Western Music</a>
					<input type="submit" value="Upload">
				</form>
			</div>
			<script type="text/javascript">
				$(function(){
					setTimeout(function(){
						$('.text-animation').removeClass('hidden');
					}, 500);
				});
				const realFileBtn = document.getElementById("real-file");
				const customBtn = document.getElementById("custom-button");
				const customTxt = document.getElementById("custom-text");
				const fileName = document.getElementById("real-file");

				customBtn.addEventListener("click", function() {
					realFileBtn.click();
				});

				realFileBtn.addEventListener("change", function() {
					if (fileName.value) {
						customTxt.innerHTML = fileName.files[0].name;
					} else {
						customTxt.innerHTML = "No file chosen, yet.";
					}
				});				
			</script>
		</div>
	</body>
</html>