<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:http://localhost/pharmacy/Client/shopping.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        section{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            background: url(./image/bg2.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .form-box{
            position: relative;
            width: 400px;
            height: 450px;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.5);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        h2{
            font-size: 2em;
            color: #fff;
            text-align: center;
        }
        .inputbox{
            position: relative;
            margin: 30px 0;
            width: 310px;
            border-bottom: 2px solid #fff;
        }
        .inputbox label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: #fff;
            font-size: 1em;
            pointer-events: none;
            transition: .5s;
        }
        input:focus ~ label,
        input:valid ~ label{
            top: -5px;
        }
        .inputbox input{
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            padding: 0 35px 0 5px;
            color: #fff;
        }
        .inputbox i{
            position: absolute;
            right: 8px;
            color: #fff;
            font-size: 1.2em;
            top: 20px;
        }
        .forget{
            margin: -15px 0 15px;
            font-size: .9em;
            color: #fff;
            display: flex;
            justify-content: center;
        }
        .forget label input{
            margin-right: 3px;
        }
        .forget label a{
            color: #fff;
            text-decoration: none;
        }
        .forget label a:hover{
            text-decoration: underline;
        }
        .button{
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 500;
        }
        .register{
            font-size: .9em;
            color: #fff;
            text-align: center;
            margin: 25px 0 10px;
        }
        .register p a:hover{
            text-decoration: underline;
        }
        .link{
            color: #fff;
            text-decoration: none;
            transition: .3s;
        }
        .link:hover{
            color: blue;
            text-decoration: underline;
        }
        .message{
            color: red;
            text-align: center;
            margin-top: 5px;
        }
        @media (max-width: 450px){
    .form-box{
        width: 100%;
        height: 100vh;
        border: none;
        border-radius: 0px;
    }
    .inputbox{
        width: 320px;
    }
}
    </style>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" autocomplete="off" method="post" id="login" enctype="multipart/form-data">
                    <h2>Login</h2>
                    <?php
                    if(isset($message)){
                        foreach($message as $message){
                            echo '<div class="message">'.$message.'</div>';
                        }
                    }
                    ?>
                    <div class="inputbox">
                         <i class="bx bx-envelope icon"></i>
                        <input autocomplete="false" type="email" name="email" required>
                        <label>Email</label>
                    </div>
                     <div class="inputbox">
                        <i class="bx bx-show showHidePw"></i>
                        <input autocomplete="false" type="password" name="password" class="password" required>
                        <label>Password</label>
                    </div>
                    <div class="forget">
                        <label><input type="checkbox">Remember Me <a href="#">Forgot Password</a></label>
                    </div>
                    <input type="submit" name="submit" value="login now" class="button">
                    <div class="register">
                        <p>Don't have a acount <a href="register.php" class="link">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        const pwShowHide = document.querySelectorAll(".showHidePw");
        const pwFields = document.querySelectorAll(".password");

        // JS code to show and hide a password
        pwShowHide.forEach(eye => {
        eye.addEventListener("click", () => {
            pwFields.forEach(pwField => {
            if (pwField.type === "password") {
                pwField.type = "text";

                pwShowHide.forEach(icon => {
                icon.classList.replace("bx-show", "bx-low-vision");
                });
            } else {
                pwField.type = "password";

                pwShowHide.forEach(icon => {
                icon.classList.replace("bx-low-vision", "bx-show");
                });
            }
            });
        });
        });
    </script>
</body>
</html>