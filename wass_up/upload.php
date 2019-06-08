<html>
<?php
session_start();
//check whether the visitor is a member
if(isset($_SESSION['login'])==false){
    header("Location: index.php");
}
if(isset($_GET['value'])){
	if($_GET['value']=='wrong_type'){
		echo "alert('wrong type!')";
	}
	else if($_GET['value']=='error'){
		echo "Fail to upload!";
	}
	else if($_GET['value']=='success'){
		echo "Uploaded!";
	}
}
?>
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body style="background-color:LightCyan">
    <form action="upload.php"  method="post" enctype="multipart/form-data">
        Select music to upload:
        <input type="file" name="uploaded_file">
        <input type="submit" value="upload">
    </form>
</body>
</html>