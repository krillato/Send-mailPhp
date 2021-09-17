<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ส่งข้อความถึงแอดมิน</title>
    <link rel="stylesheet" type="text/css" media="all" href="mail_style.css?ver=1001" />
</head>

<body>

    <?php 
    session_start();
    include('../db/server.php');  

    $username=$_SESSION['username'];
    $query_user = "SELECT * FROM `user_table` WHERE username = '$username' " ;
    $result_user = mysqli_query($conn, $query_user);
    $row_user = mysqli_fetch_array($result_user);
    //echo $row_user['User_Email'];
    //echo $row_user['username'];
    
        if(empty($username)){
            echo "<script language=\"JavaScript\">";
            echo "alert('กรุณาเข้าสู่ระบบก่อนส่งข้อความถึงเรา ^_^');";
            echo "</script>";
            session_destroy();
            mysqli_close($conn);

                header('location: ../login.php');
        }
?>

    <form action="user_contact_admin_db.php" id="sendmail" class="mail" method="post" target="iframe_target">
        <iframe id="iframe_target" name="iframe_target" src="#"
            style="width:0;height:0;border:0px solid #fff;"></iframe>
        <div class="msg"></div>

        <h2>Contact us</h2>

        <div class="from-control">
            <p>Name</p>
            <input type="text" name="username" id="name" class="txt" placeholder="<?php echo $row_user['username'];?>"
                value="<?php echo $row_user['username'];?>" readonly>
        </div>

        <div class="from-control">
            <p>Email</p>
            <input type="text" name="email" id="email" class="txt" placeholder="<?php echo $row_user['User_Email'];?>"
                value="<?php echo $row_user['User_Email'];?>" readonly>
        </div>

        <div class="from-control">
            <p>หัวเรื่อง</p>
            <input type="text" name="header" id="header" class="txt" placeholder="ใส่หัวเรื่อง">
        </div>

        <div class="from-control">
            <p>เนื้อหา</p>
            <textarea id="detail" name="detail" class="txt textarea" placeholder="ข้อความ"></textarea>
        </div><br><br>

        <button type="submit" name="reg_user" class="btn-submit">Send</button>

    </form>







</body>

</html>