<?php
session_start();
error_reporting(0);

$error_flag = FALSE;
$notfound_flag = FALSE;

class MyDB extends SQLite3
{
    function __construct()
    {
      $this->open('../../database.db');
    }
}
$db = new MyDB();
if(!$db){
    echo $db->lastErrorMsg();
} else {
    //echo "Opened database successfully\n";
}

$sql = 'SELECT * from USERS where USERNAME="'.$_POST["username"].'";';

$ret = $db->query($sql);

while($row = $ret->fetchArray(SQLITE3_ASSOC)){

    if(empty($_POST["username"])==FALSE && empty($_POST["problem"])==FALSE){

        $username=$_POST["username"];
        $problem=$_POST["problem"];
        if($row["USERNAME"]==$_POST["username"]){

            if($row["PROBLEM"]==$_POST["problem"]){
                $_SESSION["USERNAME"]=$_POST["username"];
                $_SESSION["PASSWORDS"]=$_POST["passwords"];
                $_SESSION["NAMES"]=$row["NAMES"];
                $_SESSION["GENDER"]=$row["GENDER"];
                $_SESSION["ID"]=$row["ID"];
                header('Location: update_password.php');

            }else{
                $error_flag = TRUE;
                break;
            }

        }else{
            $notfound_flag = TRUE;
        }

    }else{

    }
    $db->close();

}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>忘記密碼</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body style="background:url(background.png); background-size:cover">
    <br><br><br><br><br><br>

    <div class="container">
      <div class="col-md-6 col-md-offset-3">
        <div class="jumbotron">
          <h2 class="text-center">忘記密碼</h2><br/>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <input class="form-control input-lg"  type="text" name="username" required="TRUE" placeholder="Enter Username"/><br/>
            <input class="form-control input-lg"  type="text" name="problem" required="TRUE" placeholder="你最喜歡的動物？"/><br/>
            <input class="btn btn-primary btn-lg btn-block" type="submit" value="送出"/>
          </form>
          <br/>
          <?php if($error_flag){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 答案錯誤！
            </div>
          <?php }?>

          <?php if($notfound_flag){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 未找到本使用者！
            </div>
          <?php }?>
        </div>
      </div>
    </div>
  </body>
</html>