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
            ?>
            <p><?php echo $row->name;?><p> 
<?php     
        }
        // else echo "name doesnt exist";
    }
?>
