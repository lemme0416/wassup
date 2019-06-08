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
		<p>修改密碼</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('blue')">
		<p>上傳音樂</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('red')">
		<p>排行榜</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('green')">
		<p>list1</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('orange')">
		<p>list2</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('purple')">
		<p>list3</p>
	</div>

    <script>
        function interact() {
			var x = document.getElementsByName("text")[0].value;
			var address = "right.php?text=" + x;
			parent.frames[1].location = address;
        }
		function color_deep(x) {
			x.style.backgroundColor = 'DimGray';
		}
		function color_shallow(x) {
			x.style.backgroundColor = 'gray';
		}
		function jump(x){
			var address = x + ".php";
			parent.frames[1].location = address;
		}
	</script>

</body>
</html>