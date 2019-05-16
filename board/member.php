<?php
    session_start();
    //error_reporting(0);

    if(isset($_SESSION["USERNAME"])==FALSE) {
        header('Location: index.php');
    }
    else{

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>會員中心</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body style="background:url(background.png); background-size:cover">
        <br><br><br><br>
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div class="jumbotron"> 
                    <h2 class="text-center">會員中心</h2>
                    <h3>歡迎，<?php echo $_SESSION["NAMES"];?></h3>
                    <a href="update_password.php">修改密碼？</a>
                    <br>
                    <a class="btn btn-primary btn-lg btn-block" href="board.php">留言板</a>
                </div>
            </div>
        </div>
    </body>
</html>
