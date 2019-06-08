<html>
<?php
session_start();
//check whether the visitor is a member
if(isset($_SESSION['login'])==false){
    header("Location: index.php");
}
if(isset($_GET['value'])){
	if($_GET['value']=='wrong_type'){
		echo "<script>alert('wrong type!')</script>";
	}
	else if($_GET['value']=='error'){
		echo "<script>alert('Fail to upload!')</script>";
	}
	else if($_GET['value']=='success'){
		echo "<script>alert('Uploaded!')</script>";
	}
}
?>
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body style="background-color:LightCyan">
    <form action="save_upload.php"  method="post" enctype="multipart/form-data">
        Select music to upload:
        <input type="file" name="uploaded_file" accept=".mp3">
        <input type="submit" value="upload">
    </form>
</body>
</html>