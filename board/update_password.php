<?php
    session_start();
    //error_reporting(0);

    $noInfo_flag = false;
    $success_flag=false;
    $fail_flag=false;
    
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
    if (isset($_SESSION["USERNAME"])==FALSE) {
        header('Location: index.php');
    }
    if(isset($_POST['submit'])==true){

        if(empty($_POST['passwords'])==true){
            $noInfo_flag = true;
        }
    }
    if(isset($_POST['submit'])==true && empty($_POST['passwords'])==false){
        
        $UpdateNewPassword = 'UPDATE USERS set PASSWORDS="'.$_POST['passwords'].'" where USERNAME="'.$_SESSION['USERNAME'].'";';
        $UpdateNewPassword_ret = $db->exec($UpdateNewPassword);

        if(!$UpdateNewPassword_ret){
            $fail_flag=true;
            echo $db->lastErrorMsg();

        }else{
            $success_flag=true;

        }
        $db->close();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>會員註冊</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body style="background:url(background.png); background-size:cover">
        <br>
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div class="jumbotron"> 
                <h2 class="text-center">修改密碼</h2>
                <hr>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="form-group">
                        <label for="input-passwords">NEW PASSWORD *</label>
                        <input type="password" class="form-control" id="input-passwords" name="passwords" placeholder="新密碼">
                    </div>
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="修改" name="submit">
                </form>
                <?php if($noInfo_flag){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            請輸入新密碼！
                        </div>
                    <?php }?>

                    <?php if($success_flag){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            修改成功！ <a style ="text-align:center" href="http://140.114.87.219/~s106062133/board/index.php">馬上登入？</a>
                        </div>
                    <?php }?>

                    <?php if($fail_flag){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            修改失敗！
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </body>
</html>