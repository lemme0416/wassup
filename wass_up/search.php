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
        $sth = $dbh->prepare("SELECT * FROM music WHERE name = '%$str%'");
        $sth->setFetchMode(PDO:: FETCH_OBJ);
        $sth->execute();

        if($row = $sth->fetch()){
            ?>
            <br><br><br>
            <table>
                <tr>
                    <th>Name</th>
                    <th>id</th>
                </tr>
                <tr>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->id; ?></td>
                </tr>
            </table>
<?php            
        }
        else{
            echo "name doesnt exist!";
        }
    }
?>