<?php
	session_start();
?><html>
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
        $_SESSION['last'] = 'show_search_result.php';
        $dsn = 'mysql:host=localhost;dbname=wassup';
        $dbh = new PDO($dsn,$CFG['username'],$CFG['pw']);
        $inst = 'select * from '.$_SESSION['login'].'_list;';
        $sth1 = $dbh->prepare($inst);
        $sth1->execute();
        $arr = array();
        while($col=$sth1->fetch(PDO::FETCH_ASSOC)){
                array_push($arr, $col['list_name']);
        }
        if(isset($_GET["search"])){
            $str = $_GET["search"];
            $sth = $dbh->prepare("SELECT * FROM music WHERE name like '%$str%';");
            $sth->setFetchMode(PDO:: FETCH_OBJ);
            $sth->execute();
            
            while($row = $sth->fetch()){
                $song_name = $row->name;
                $song_id = $row->id;
                echo '<div>
                ';
                echo '<img src="https://i.imgur.com/T1iuPh7.png" onmouseover="play_black(this)" onmouseout="play_white(this)" onclick="jump('.$song_id.','."'music'".')">';
                echo '<p>'.htmlentities($song_name).'</p>';
                echo '<form method="POST" onclick="bubble(event)" id="'.$song_id.'" action="add_to_list.php?song_name='.htmlentities($song_name).'&song_id='.$song_id.'"><input type="submit" value="+" title="Add to the list"></form>';
                echo '<select name="list_name" onclick="bubble(event)" form="'.$song_id.'">';
                echo '<option value="0">Choose a list</option>';
                foreach($arr as $value){
                    $html_value = htmlentities($value);
                    echo '<option value='."'$html_value'".'>'.$html_value.'</option>';
                }
                echo '</select>';
                echo '</div>';         
            ?>
        <?php     
            }
        }
        else echo "<h2>name doesnt exist</h2>";

    ?> 
    </body>
</html>