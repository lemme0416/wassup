<?php
    session_start();
    error_reporting(0);
    $im_admin = FALSE;

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
    //如果沒有登入的SESSION，就轉址
    if (isset($_SESSION["USERNAME"])==FALSE) {
        header('Location: index.php');
    }
    if($_SESSION["USERNAME"] == "admin"){
        $im_admin = true;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>會員留言板</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
<body style="background:url(background.png); background-size:cover">
    <br>
    <div class="container">
        <h3 class="text-center">會員留言板</h3>
        <hr>
        <?php
            $sql = 'SELECT * FROM MSG;';
            $re = $db->query($sql);
            $row;
            while($row = $re->fetchArray(SQLITE3_ASSOC))
            {
                $userSql = 'SELECT * FROM USERS WHERE ID = "'.$row["GUEST"].'";';
                $userRe = $db->query($userSql);
                $userRow = $userRe->fetchArray(SQLITE3_ASSOC);

                echo "<div class='panel panel-default'>";
                    echo "<div class='panel-heading'>";
                        echo $userRow['NAMES'];
                        echo "<span class='pull-right'>";
                            echo $row['DATES']." ".$userRow['GENDER']." ";
                            if($im_admin) {
                                echo "<a href='msg_del.php?ID=$row[ID]' class='btn btn-danger btn-xs' >DELETE</a>";
                            };
                        echo "</span>";
                    echo "</div>";
                    echo"<div class='panel-body'>";
                        echo $row['CONTENTS']; 
                        echo "<span class='pull-right'>";
                            if($im_admin) {    
                                echo "<form action='msg_edit.php?ID=$row[ID]' method='POST'>";
                                    echo "<textarea name='edit_msg' class='form-control'></textarea>";
                                    echo "<br>";
                                    echo "<input type='submit' name='edit_submit' value='EDIT' class='btn btn-warning btn-xs pull-right'>";
                                echo "</form> ";  
                            };
                        echo "</span>";
                    echo "</div>";
                echo "</div>";
            }
        ?>
        <hr>
        <?php if(!$im_admin){ ?>
            <p class="pull-right">以 <?php echo $_SESSION["NAMES"]; ?> 的身份留言</p>
            <h4>新增留言</h4>
            <form action="msg_add.php" method="POST">
                <textarea name="msg" class="form-control"></textarea>
                <br>
                <input type="submit" name="submit" value="送出" class="btn btn-primary btn-sm pull-right">
            </form>            
        <?php }?>
    </div>
</body>
</html>