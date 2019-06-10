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
		$name = $dbh->prepare('select * from users where id = ? ;');
		$name->execute(array($_SESSION['login']));
		while($row=$name->fetch(PDO::FETCH_ASSOC)){
			echo '<p>Hello, '.$row['name'].'</p>';
		}
	?>
	</div>
	<!-- <div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('modify_pw.php')"> -->
		<h2 onclick="jump('modify_pw.php')">Modify Password</h2>
	<!-- </div> -->
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('upload.php')">
		<p>上傳音樂</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('red.php')">
		<p>排行榜</p>
	</div>
	<?php
		$inst = 'select * from '.$_SESSION['login'].'_list;';
		$sth = $dbh->prepare($inst);
		$sth->execute();
		while($row=$sth->fetch(PDO::FETCH_ASSOC)){
			echo '<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('."'list.php?name=123'".')">';
			echo '<p>'.$row['list_name'].'</p>';
			echo '</div>';	
		}
	?>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="show_form()">
		<p>新增清單</p>
	</div>
	<form method = "POST" hidden = "true" action="add_list.php" id="hidden_form" style="margin:0px 0px 0px 10px">
		<input type="text" required="true" name="list_name">
		<input type="submit" value="新增">
	</form>

    <script>
		function color_deep(x) {
			x.style.backgroundColor = 'DimGray';
		}
		function color_shallow(x) {
			x.style.backgroundColor = 'gray';
		}
		function jump(x){
			parent.frames[2].location = x;
		}
		function show_form(){
			var hid = document.getElementById("hidden_form");
			hid.hidden = !(hid.hidden);
		}
	</script>

</body>
</html>