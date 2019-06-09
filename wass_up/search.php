<!DOCTYPE html>
<html> 
    <head> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
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
            echo '<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('."'$row->name'".')">
            ';
            echo"	<p>$row->name</p>
            ";
            echo"</div>
            ";            
        ?>
<?php     
        }
        // else echo "name doesnt exist";
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
		parent.frames[3].location = address;
	}
</script>