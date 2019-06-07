<html>
<head>
    <meta charset="utf-8" />
    <title>music</title>
	<style>
		div{
			overflow: hidden;
			background-color: DarkSlateGray;
			border: 2px solid white;
			margin: 2px 2px;
		}
		body{
			background-color: lightblue;
			margin: 0px;
		}
		p{
			text-align: center;
			color: white;
		}
	</style>
</head>
<body>

<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    $sth = $dbh->prepare('select * from music;');
    $sth->execute();
	while($row=$sth->fetch(PDO::FETCH_ASSOC)){
		$song_name = $row['name'];
		var_dump($song_name);
		echo '<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump(\'$song_name\')">
				<p>$song_name</p>
			</div>';
	}
?>
<script>
    function interact() {
		var x = document.getElementsByName("text")[0].value;
		var address = "right.php?text=" + x;
		parent.frames[1].location = address;
    }
	function color_deep(x) {
		x.style.backgroundColor = 'black';
	}
	function color_shallow(x) {
		x.style.backgroundColor = 'DarkSlateGray ';
	}
	function jump(x){
		var address = "music2.php?name=" + x;
		parent.frames[2].location = address;
	}
</script>
</body>
</html>