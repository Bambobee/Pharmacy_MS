<?php include('config.php'); ?>
<?php
session_start();
if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM tbl_admin WHERE email = '$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        if ($row['userType'] == 'admin') {
            $_SESSION['user_id'] = $row['id'];
            header('location:http://localhost/pharmacy/Admin/index.php');
        }  else {
            // If userType is not specified, assume a default value
            $_SESSION['user_id'] = $row['id'];
            header('location:http://localhost/pharmacy/Admin_login.php');
        }

    }else{
        $error[] = 'incorrect email or password!';
    }
};
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
    * {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    section {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        width: 100%;
        background: url(./image/bg2.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        animation: animateBg 5s linear infinite;
    }

    @keyframes animateBg {
        100% {
            filter: hue-rotate(360deg);
        }
    }

    .form-box {
        position: relative;
        width: 400px;
        height: 450px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        backdrop-filter: blur(15px);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    h2 {
        font-size: 2em;
        color: #fff;
        text-align: center;
    }

    .inputbox {
        position: relative;
        margin: 30px 0;
        width: 310px;
        border-bottom: 2px solid #fff;
    }

    .inputbox label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        color: #fff;
        font-size: 1em;
        pointer-events: none;
        transition: .5s;
    }

    input:focus~label,
    input:valid~label {
        top: -5px;
    }

    .inputbox input {
        width: 100%;
        height: 50px;
        background: transparent;
        border: none;
        outline: none;
        font-size: 1em;
        padding: 0 35px 0 5px;
        color: #fff;
    }

    .inputbox i {
        position: absolute;
        right: 8px;
        color: #fff;
        font-size: 1.2em;
        top: 20px;
    }

    .forget {
        margin: -15px 0 15px;
        font-size: .9em;
        color: #fff;
        display: flex;
        justify-content: space-between;
    }

    .forget label input {
        margin-right: 3px;
    }

    .forget label a {
        color: #fff;
        text-decoration: none;
    }

    .forget label a:hover {
        text-decoration: underline;
    }

    .button {
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

    .error-msg {
        color: red;
        display: flex;
        justify-content: center;
        text-align: center;
        margin-top: 5px;
    }

    @media (max-width: 450px) {
        .form-box {
            width: 100%;
            height: 100vh;
            border: none;
            border-radius: 0px;
        }

        .inputbox {
            width: 320px;
        }
    }
    </style>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post" id="login" autocomplete="off" enctype="multipart/form-data">
                    <h2>Login</h2>

                    <?php
                        if(isset($error)){
                            foreach($error as $error){
                                echo '<span class="error-msg">'.$error.'</span>';
                            };
                        };
                        ?>

                    <div class="inputbox">
                        <i class="bx bx-envelope icon"></i>
                        <input autocomplete="false" type="email" name="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <i class="bx bx-show showHidePw"></i>
                        <input autocomplete="false" type="password" name="password" class="password" required>
                        <label for="">Password</label>
                    </div>
                    <input type="submit" name="submit" value="login now" class="button">
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