<html>
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
<?php
    if(isset($_GET['name'])){
        $song_src = "music/" + $_GET['name'] + ".mp3";
    }
    else $song_src = "music/might_as_well.mp3";
    echo "
        <audio controls autoplay>
            <source src="$song_src" type="audio/ogg">
            Your browser does not support the audio element.
        </audio>
    "
?>
</body>
</html>