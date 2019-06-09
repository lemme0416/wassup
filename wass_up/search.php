<!DOCTYPE html>
<html> 
    <head> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
    </head> 
    <body bgcbor="#ffffff" text="#000000"> 
        <form method="post" action="search.php"> 
            <input type="text" name="search" placeholder="Search">
            <input type="submit" value=">>">
        </form> 
    </body> 
</html>
<?php
    require_once('login.php');
    $dsn = 'mysql:host=localhost;dbname=wassup';
    $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
    $output ='';
    if(isset($_POST['search'])){
        $searchq = $_POST['search'];
        $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
        $query = mysql_query("SELECT * from music where name like'%$searchq%'") or die("could not search!");
        $count = mysql_num_rows($query);
        if($count == 0){
            $output = 'There was no search results!';
        }
        else{
            while ($row = mysql_fetch_array($query)) {
                $fname = $row['name'];
                $output .= '<div>'.$fname.'</div>';
            }
        }
    }
    print("$output");
?>