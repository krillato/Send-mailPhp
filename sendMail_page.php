<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ส่งข้อความถึงผู้ใช้</title>
    <link rel="stylesheet" type="text/css" media="all" href="mail_style.css?ver=1001" />
</head>

<body>

<?php 
    session_start();
    include('../db/server.php'); 

    $username= $_GET['username'];
    $email = $_GET['email']; 
?>

    <form action="" id="sendmail" class="mail">
        <div class="msg"></div>

        <h2>Contact us</h2>

        <div class="from-control">
            <p>Name</p>
            <input type="text" id="name" class="txt" placeholder="ใส่ชื่อ" value="<?php echo $username;?>" readonly>
        </div>

        <div class="from-control">
            <p>Email</p>
            <input type="text" id="email" class="txt" placeholder="ใส่ email" value="<?php echo $email;?>" readonly>
        </div>

        <div class="from-control">
            <p>Hearder</p>
            <input type="text" id="header" class="txt" placeholder="ใส่หัวเรื่อง">
        </div>

        <div class="from-control">
            <p>Detail</p>
            <textarea id="detail" class="txt textarea" placeholder="ข้อความ"></textarea>
        </div><br><br>

        <button type="button" onclick="sendEmail()" value="Send an email" class="btn-submit">Send</button>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    function sendEmail() {
        //เก็บค่าจาก id
        var name = $("#name");
            var email = $("#email");
            var header = $("#header");
            var detail = $("#detail");

        //ถ้าไม่มีค่าว่าง ให้ส่งค่า
        if(isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(header) && isNotEmpty(detail)) {
            $.ajax({
                url: 'sendMail_admin_db.php', //ส่งค่าไปหน้า sendEmail.php
                method: 'POST', // ส่งแบบ POST
                dataType: 'json', // รูปแบบ json
                data: { //ข้อมูลที่ส่งไป
                    name: name.val(),
                    email: email.val(),
                    header: header.val(),
                    detail: detail.val()
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

<?php 
    session_destroy();
    unset($_SESSION['username']);
?>