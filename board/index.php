<?php
session_start();
//error_reporting(0);

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

    if(empty($_POST["username"])==FALSE && empty($_POST["passwords"])==FALSE){

        $username=$_POST["username"];
        $passwords=$_POST["passwords"];
        if($row["USERNAME"]==$_POST["username"]){

            if($row["PASSWORDS"]==$_POST["passwords"]){
                $_SESSION["USERNAME"]=$_POST["username"];
                $_SESSION["PASSWORDS"]=$_POST["passwords"];
                $_SESSION["NAMES"]=$row["NAMES"];
                $_SESSION["GENDER"]=$row["GENDER"];
                $_SESSION["ID"]=$row["ID"];
                header('Location: member.php');

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
    <title>會員登入</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body style="background:url(background.png); background-size:cover">
    <br><br><br><br><br><br>

    <div class="container">
      <div class="col-md-6 col-md-offset-3">
        <div class="row jumbotron">
          <h2 class="text-center">會員登入</h2><br/>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <input class="form-control input-lg"  type="text" name="username" required="TRUE" placeholder="Enter Username"/><br/>
            <input class="form-control input-lg"  type="password" name="passwords" required="TRUE" placeholder="Enter Password"/><br/>
            <input class="btn btn-primary btn-lg btn-block" type="submit" value="登入"/>
            <a class="btn btn-default btn-lg btn-block" href="register.php">會員註冊</a>
            <a href="http://140.114.87.219/~s106062133/board/forget_password.php">忘記密碼？</a>            
          </form>
          <br/>
          <?php if($error_flag){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 密碼錯誤！
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
    <p style="text-align:center">Host Username: admin</p>
    <p style="text-align:center">Host Password: admin</p>
  </body>
</html>