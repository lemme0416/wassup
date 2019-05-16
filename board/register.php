<?php

$noInfo_flag = false;
$duplicate_flag = false;
$success_flag=false;
$fail_flag=false;

// error_reporting(0);

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
    // echo "Opened database successfully\n";
}
if(isset($_POST['submit'])==true){

    if(empty($_POST['username'])==true || empty($_POST['gender'])==true || empty($_POST['names'])==true || empty($_POST['passwords'])==true|| empty($_POST['problem'])==true){
        $noInfo_flag = true;
    }
}

if(isset($_POST['submit'])==true && empty($_POST['username'])==false && empty($_POST['gender'])==false && empty($_POST['names'])==false && empty($_POST['passwords'])==false && empty($_POST['problem'])==false){

 $sql ='SELECT * from USERS where USERNAME="'.$_POST["username"].'"; ';
 $ret = $db->query($sql);
 $row = $ret->fetchArray(SQLITE3_ASSOC);

    if($row["USERNAME"]==$_POST["username"]){
        $duplicate_flag = true;
    }else{
    
        $SaveNewData = "INSERT INTO USERS (NAMES,USERNAME,GENDER,PASSWORDS,PROBLEM) VALUES ('".$_POST['names']."', '".$_POST['username']."', '".$_POST['gender']."', '".$_POST['passwords']."', '".$_POST['problem']."');";
        $SaveNewData_ret = $db->exec($SaveNewData);

        if(!$SaveNewData_ret){
            $fail_flag=true;
            echo $db->lastErrorMsg();

        }else{
            $success_flag=true;

        }
        $db->close();
    }
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
                    <h2 class="text-center">會員註冊</h2>
                    <hr>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="form-group">
                            <label for="input-username">USERNAME *</label>
                            <input type="text" class="form-control" id="input-username" name="username" placeholder="使用者名稱">
                        </div> 
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="boy">GENDER *</label><br>
                                <input class="form-check-input" type="radio" name="gender" id="boy" value="男生"> 男生
                                <input class="form-check-input" type="radio" name="gender" id="girl" value="女生"> 女生
                                <input class="form-check-input" type="radio" name="gender" id="other" value="其他"> 其他
                        </div>
                        <div class="form-group">
                            <label for="input-name">NICKNAME *</label>
                            <input type="text" class="form-control" id="input-name" name="names" placeholder="暱稱">
                        </div>
                        <div class="form-group">
                            <label for="input-password">PASSWORD *</label>
                            <input type="password" class="form-control" id="input-password" name="passwords" placeholder="密碼">
                        </div>
                        <div class="form-group">
                            <label for="input-problem">PROBLEM *</label>
                            <input type="text" class="form-control" id="input-problem" name="problem" placeholder="喜歡的動物？">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="註冊" name="submit">
                        <a href="http://140.114.87.219/~s106062133/board/index.php">註冊過了？</a>
                    </form>
                    <?php if($noInfo_flag){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            請輸入所有欄位！
                        </div>
                    <?php }?>

                    <?php if($duplicate_flag){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            此 USERNAME 已經被註冊過！
                        </div>
                    <?php }?>

                    <?php if($success_flag){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            註冊成功！ <a style ="text-align:center" href="http://140.114.87.219/~s106062133/board/index.php">馬上登入？</a>
                        </div>
                    <?php }?>

                    <?php if($fail_flag){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            註冊失敗！
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </body>
</html>