<?php
        session_start();
        include('../db/server.php');

        

        /* ส่วนอัพเดตเข้าระบบ */
        if (isset($_POST['reg_user'])) {
    
            
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $head = mysqli_real_escape_string($conn, $_POST['header']);
            $detail = mysqli_real_escape_string($conn, $_POST['detail']);

            
            
         $sql = "INSERT INTO contact_from_user 
        (username, contact_header, contact_detail, user_email) 
        VALUES
         ('$username', '$head', '$detail', '$email' )";
         
         
         echo "<script language=\"JavaScript\">";
            echo "alert('ส่งข้อความถึงแอดมินสำเร็จแล้ว ^_^');";
            echo "</script>";

        mysqli_query($conn, $sql); 
        mysqli_close($conn);
        }
    
    ?>