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
            if(empty($_GET['search'])== false){
                $str = $_GET["search"];
                $sth = $dbh->prepare("SELECT * FROM music WHERE name like '%$str%'");
                $sth->setFetchMode(PDO:: FETCH_OBJ);
                $sth->execute();

                while($row = $sth->fetch()){
                    echo '<div class="song_div" onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump('."'$row->name'".')">
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