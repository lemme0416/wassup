<html>
    <head>
        <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
        
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="css/show_search_result.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <script src="js/show_search_result.js"></script>
    </head>
    <body>
        <?php
            require_once('login.php');
            $dsn = 'mysql:host=localhost;dbname=wassup';
            $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
            if(isset($_GET["search"])){
                $str = $_GET["search"];
                $sth = $dbh->prepare("SELECT * FROM music WHERE name like '%$str%'");
                $sth->setFetchMode(PDO:: FETCH_OBJ);
                $sth->execute();
                
                while($row = $sth->fetch()){
                    $row_name = htmlentities($row->name);
                    echo '<div class="song_div" onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('."'$row_name'".')">
                    ';
                    echo"	<p>".$row_name."</p>
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

    </body>
</html>