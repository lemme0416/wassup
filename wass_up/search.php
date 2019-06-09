<!DOCTYPE html>
<html> 
    <head> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
    </head> 
    <body bgcbor="#ffffff" text="#000000"> 
        <form method="post" action="search.php"> 
            <input type="text" name="search" placeholder="Search">
            <input type="submit" name="submit" value=">>">
        </form> 
    </body> 
</html>
<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    if(isset($_POST['submit'])){
        $str = $_POST["search"];
        $sth = $dbh->prepare("SELECT * FROM music WHERE name like '%$str%'");
        $sth->setFetchMode(PDO:: FETCH_OBJ);
        $sth->execute();

        while($row = $sth->fetch()){
            $song_name = $row['name'];
            $song_string = (string)$song_name;
            echo '<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('."'$song_string'".')">
            ';
            echo"	<p>$song_name</p>
            ";
            echo"</div>
            ";        
        }
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