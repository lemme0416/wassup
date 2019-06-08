<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>left</title>
	<style>
		div{
			overflow: hidden;
			background-color: gray;
		}
		body{
			background-color: gray;
			margin: 0px;
		}
		p{
			text-align: center;
			color: white;
		}
	</style>
</head>
<body>
<<<<<<< Updated upstream
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)">
	<?php
		require_once('login.php');
		$dsn = 'mysql:host=localhost;dbname=wassup';
		$dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
		$id_name = $_SESSION['login'];
		echo "<p>Hello, $id_name</p>"; 
	?>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('modify_pw')">
=======
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('yellow.php')">
>>>>>>> Stashed changes
		<p>修改密碼</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('upload.php')">
		<p>上傳音樂</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('red.php')">
		<p>排行榜</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('green.php')">
		<p>list1</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('orange.php')">
		<p>list2</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('purple.php')">
		<p>list3</p>
	</div>

    <script>
		function color_deep(x) {
			x.style.backgroundColor = 'DimGray';
		}
		function color_shallow(x) {
			x.style.backgroundColor = 'gray';
		}
		function jump(x){
			parent.frames[1].location = x;
		}
	</script>

</body>
</html>