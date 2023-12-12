<?php

include 'config.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $contact = mysqli_real_escape_string($conn, $_POST['contact']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = './Client/uploaded_img/'.$image;

   //Instantiation and passing `true` enables exceptions
   $mail = new PHPMailer(true);

   try {
       //Enable verbose debug output
       $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;

       //Send using SMTP
       $mail->isSMTP();

       //Set the SMTP server to send through
       $mail->Host = 'smtp.gmail.com';

       //Enable SMTP authentication
       $mail->SMTPAuth = true;

       //SMTP username
       $mail->Username = 'rickrambo29@gmail.com';

       //SMTP password
       $mail->Password = 'phgtqljdlwsukzsx';

       //Enable TLS encryption;
       $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

       //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
       $mail->Port = 587;

       //Recipients
       $mail->setFrom('rickrambo29@gmail.com', 'Pharmacy.com');

       //Add a recipient
       $mail->addAddress($email, $name);

       //Set email format to HTML
       $mail->isHTML(true);

       $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

       $mail->Subject = 'Email verification';
       $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b> Thank you for working wih use</p>';

       $mail->send();
       // echo 'Message has been sent';


   $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `tbl_users`(name, email, contact, address, password, image,verification_code,email_verified_at)
          VALUES('$name', '$email','$contact','$address', '$pass', '$image','$verification_code','NULL')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header("Location: email-verification.php?email=" . $email);
            exit();
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
    }

    body {
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
        background: url(./image/bg2.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .container {
        width: 100%;
        max-width: 650px;
        /* background: rgba(0, 0, 0, 0.5); */
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        backdrop-filter: blur(15px);
        padding: 28px;
        margin: 0 28px;
        /* border-radius: 10px; */
        /* box-shadow: inset -2px 2px 2px white; */
    }

    .form-title {
        font-size: 26px;
        font-weight: 600;
        text-align: center;
        padding-bottom: 6px;
        color: white;
        text-shadow: 2px 2px 2px black;
        border-bottom: solid 1px white;
    }

    .main-user-info {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 20px 0;
    }

    .user-input-box:nth-child(2n) {
        justify-content: end;
    }

    .user-input-box {
        display: flex;
        flex-wrap: wrap;
        width: 50%;
        padding-bottom: 15px;
    }

    .user-input-box .label {
        width: 95%;
        color: #fff;
        font-size: 20px;
        font-weight: 400;
        margin: 5px 0;
    }

    .user-input-box input {
        height: 40px;
        width: 95%;
        border-radius: 7px;
        outline: none;
        border: 1px solid grey;
        padding: 0 10px;
    }

    .form-submit-btn {
        margin-top: 40px;
    }

    .form-submit-btn input {
        display: block;
        width: 100%;
        margin-top: 10px;
        font-size: 20px;
        padding: 10px;
        border: none;
        border-radius: 3px;
        color: rgb(209, 209, 209);
        background: rgba(30, 30, 30, 0.5);
        transition: 0.3s;
    }

    .form-submit-btn input:hover {
        background: rgba(0, 0, 0, 0.7);
        color: rgba(255, 255, 255);
    }

    .error {
        color: red;
    }

    .address {
        width: 100%;
        text-align: center;
        color: #fff;
        font-size: 20px;
        font-weight: 400;
        margin: 5px 0;
    }

    textarea {
        display: block;
        width: 100%;
        border-radius: 7px;
        outline: none;
        padding: 10px 10px;
        margin-top: 5px;
    }

    .image {
        background: #fff;
    }

    input::-webkit-file-upload-button {
        background: #fff;
        width: 100px;
        height: 100%;
        position: relative;
        left: -10px;
        cursor: pointer;
        border: 2px solid #0e0e0e;
        border-radius: 7px;
    }

    .para {
        color: #fff;
    }

    .link {
        color: #fff;
        text-decoration: none;
        transition: .3s;
    }

    .link:hover {
        color: blue;
        text-decoration: underline;
    }
    .infor{
        text-align: center;
        color: #fff;
        margin-top: 5px;
    }

    @media(max-width: 600px) {
        .container {
            min-width: 280px;
        }

        .user-input-box {
            margin-bottom: 12px;
            width: 100%;
        }

        textarea {
            width: 95%;
        }

        .user-input-box:nth-child(2n) {
            justify-content: space-between;
        }

        .main-user-info {
            max-height: 380px;
            overflow: auto;
        }

        .main-user-info::-webkit-scrollbar {
            width: 0px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="form-title">Registration</h1>
        <p class="infor">Your information is save with us.</p>
        <form action="#" id="register" method="post" enctype="multipart/form-data">
            <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
            <div class="main-user-info">
                <div class="user-input-box">
                    <label for="fullname" class="label">Full name</label>
                    <input type="text" id="name" name="name" placeholder="Enter Full Name" />
                </div>

                <div class="user-input-box">
                    <label for="email" class="label">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" />
                </div>

                <div class="user-input-box">
                    <label for="phoneNumber" class="label">phone Number</label>
                    <input type="text" id="contact" name="contact" placeholder="Enter phone Number" />
                </div>

                <div class="user-input-box">
                    <label for="password" class="label">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" />
                </div>

                <div class="user-input-box">
                    <label for="confirmPassword" class="label">Confirm Password</label>
                    <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" />
                </div>

                <div class="user-input-box">
                    <label for="Image" class="label">Choose an Image</label>
                    <input type="file" id="image" class="image" name="image"
                        accept="image/jpg, image/jpeg, image/png" />
                </div>

                <div class="address">
                    <label for="Address" class="label">Address</label><br>
                    <textarea name="address" rows="4" id="address" placeholder="Enter your Address"></textarea>
                </div>

            </div>
            <div class="gender-detail-box">
                <p class="para">already have an account? <a class="link" href="./client-login.php">login now</a></p>
            </div>

            <div class="form-submit-btn">
                <input type="submit" name="submit" value="Register">
            </div>
        </form>
    </div>
    <script src="./jquery/jquery-3.6.1.min.js"></script>
    <script src="./jquery/jquery.validate.min.js"></script>
    <script>
    $(document).ready(() => {
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var check = false;
                return this.optional(element) || regexp.test(value);
            }
        );

        $.validator.addMethod("extension", function(value, element, param) {
            param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
            return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
        });

        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, 'File size must be less than {0} bytes');

        $("#register").validate({
            rules: {
                'name': {
                    required: true,
                    minlength: 3,
                    maxlength: 20,
                },
                'email': {
                    required: true,
                    email: true,
                },
                'contact': {
                    required: true,
                    tel: true,
                },
                'address': {
                    required: true,
                },
                'password': {
                    required: true,
                    minlength: 7,
                }

            },
            messages: {
                'name': {
                    required: "Please enter full Names.",
                    minlength: "A minimum of 3 characters is required",
                    maxlength: "Field accepts maximum of 15 characters",
                },
                'email': {
                    required: "Please enter the email.",
                    email: "Enter a valid email address",
                },
                'contact': {
                    required: "Please enter the telphone number.",
                },
                'address': {
                    required: "Please enter the address.",
                },
                'password': {
                    required: "Please enter the password.",
                    minlength: "Enter a strong password atleast 7 characters.",
                }

            },
        });
    })
    </script>

</body>

</html>