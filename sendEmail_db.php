<?php 
    session_start();
    include('../db/server.php'); 
?>
<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if(isset($_POST['email'])){
       // $name = $_POST['name'];
        $email = $_POST['email'];
        if(isset($_POST['header'])){ $header = $_POST['header'];  } else{ $header="reset password DUCKING LEARNING"; }
        
        //$detail = $_POST['detail'];

        //ดึงมาใช้
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();


        //เชื่อมต่อ db ดึงชื่อ  username
        $query = "SELECT * FROM `user_table` WHERE User_Email = '$email' " ;
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $username_send = $row['username'];
        $namesend = "Duckinglearning";
        
        

        //SMTP Setting
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "@gmail.com";
        $mail->Password = "";
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Setting
        $mail->isHTML(true);
        $mail->setFrom($row['User_Email'],$namesend);
        $mail->addAddress($email);  //sent to
        $mail->Subject = $header;
        $mail->Body = "
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset=utf-8'/>
                <title>ส่ง Email</title>
            </head>
            <body>
                <h1 style='background: #3b434c;padding: 10px 0 20px 10px;margin-bottom:10px;font-size:30px;color:white;' >
                    
                    DUCKING LEARNING
                </h1>
                <div style='padding:20px;'>
                    <div style='text-align:center;margin-bottom:50px;'>
                   < $username_send > คุณได้ร้องขอการเปลี่ยนรหัสผ่านใหม่					
                    </div>
                    <div>				
                        <h2>การกู้รหัสผ่าน สำหรับ DUCKING LEARNING : <strong style='color:#0000ff;'></strong></h2>
                        <a href='../form/resetPassword.php?username=$username_send' target='_blank'>
                            <h1><strong style='color:#3c83f9;'> >> กรุณาคลิ๊กที่นี่ เพื่อตั้งรหัสผ่านใหม่<< </strong> </h1>
                        </a>
                    </div>
                    <div style='margin-top:30px;'>
                        <hr>
                        <address>
                            <h4>ติดต่อสอบถาม</h4>
                            <p>DUCKING LEARNING</p>
                            <p>www.facebook.com/</p>
                        </address>
                    </div>
                </div>
                <div style='background: #3b434c;color: #a2abb7;padding:30px;'>
                    <div style='text-align:center'> 
                        2021 © DUCKING LEARNING Thailand
                    </div>
                </div>
            </body>
        </html>
    ";

        if($mail->send()){
            $status = "success";
            $response = "Email is sent";
        }
        else{
            $status = "failer";
            $response = "Someting is worng" . $mail->ErrorInfo ;
        }

        exit(json_encode(array("status" => $status, "response"=> $response)));
    }

?>