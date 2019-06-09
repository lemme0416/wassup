<!DOCTYPE html>
<html> 
    <head> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="css/search.css">

    </head> 
    <body> 
        <form method="post" action="search.php" class="search-box"> 
            <input type="text" name="search" required="true" placeholder="Search" class="search-txt">
            <input type="submit" name="submit" value=">"class="search-btn">
        </form> 
    </body> 
</html>
<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    if(empty($_POST['search'])== false){
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