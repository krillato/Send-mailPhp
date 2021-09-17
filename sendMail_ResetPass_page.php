<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กู้คืนรหัสผ่าน</title>
    <link rel="stylesheet" type="text/css" media="all" href="mail_style.css?ver=1001" />
</head>

<body>

<?php 
    session_start();
    include('../db/server.php');  
?>



    <form action="" id="sendmail" class="mail">
        <br>
        <div class="msg"></div>

        <h2>ลืมรหัสผ่าน</h2><br><br>


        <div class="from-control">
            <p>Email :</p><br>
            <input type="text" id="email" class="txt" placeholder="email ที่ต้องการกู้รหัสผ่าน">
        </div><br><br><br>

       

        <button type="button" onclick="sendEmail()" value="Send an email" class="btn-submit">Send</button>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    function sendEmail() {
        //เก็บค่าจาก id
        
            var email = $("#email");
            
            

        //ถ้าไม่มีค่าว่าง ให้ส่งค่า
        if( isNotEmpty(email) )  {
            $.ajax({
                url: 'sendEmail_db.php', //ส่งค่าไปหน้า sendEmail.php
                method: 'POST', // ส่งแบบ POST
                dataType: 'json', // รูปแบบ json
                data: { //ข้อมูลที่ส่งไป
                    
                    email: email.val(),
                    

                },success: function (response) { //ถ้าส่งสำเร็จ
                    $('#sendmail')[0].reset(); //เคลียฟอร์มให้ว่าง
                    $('.msg').text("ส่งข้อควาถึงผู้ใช้เรียบร้อย"); //แทรกคำที่ div.id 

                }
            });
        }
    }

    //ถ้ามีค่าว่างให้มีขอบสีแดง ตรงช่องที่ไม่ได้ใส่
    function isNotEmpty(caller) {
            if(caller.val() == "") {
                caller.css('border', '2px solid red');
                return false;
            }
            else caller.css('border', '');

            return true;
        }



    </script>
</body>

</html>