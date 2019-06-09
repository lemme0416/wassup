<!DOCTYPE html>
<html> 
    <head> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="css/search.css">

    </head> 
    <body> 
        <div>
            <form method="post" action="show_search_result.php" class="search-box"> 
                <input type="text" name="search" required="true" placeholder="Search" class="search-txt">
                <button type="submit" name="submit" class="search-btn" onclick="jump()">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        <div> 
            
        <!-- <?php
            // require_once('login.php');
            // $dsn = 'mysql:host=localhost;dbname=wassup';
            // $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
            // if(empty($_POST['search'])== false){
            //     if(isset($_POST['submit'])){
            //         $str = $_POST["search"];
            //         $sth = $dbh->prepare("SELECT * FROM music WHERE name like '%$str%'");
            //         $sth->setFetchMode(PDO:: FETCH_OBJ);
            //         $sth->execute();

            //         while($row = $sth->fetch()){
            //             echo '<div class="song_div" onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('."'$row->name'".')">
            //             ';
            //             echo"	<p>$row->name</p>
            //             ";
            //             echo"</div>
            //             ";            
                    ?>
            <?php     
            //         }
            //         // else echo "name doesnt exist";
            //     }        
            // }

        ?> -->
    </body> 
</html>

<script>
	function jump(){
		parent.frames[2].location = "show_search_result.php";
	}
</script>