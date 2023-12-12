<?php
include 'config.php';
if (isset($_POST["verify_email"]))
{
    $email = $_POST["email"];
    $verification_code = $_POST["verification_code"];

    // mark email as verified
    $sql = "UPDATE tbl_users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
    $result  = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 0)
    {
        die("Verification code failed.");
    }else{
        header("Location:http://localhost/pharmacy/client-login.php");
    }
    exit();
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
        max-width: 400px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        backdrop-filter: blur(15px);
        padding: 28px;
        margin: 0 28px;
        text-align: center;
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
    form{
        padding-top: 20px;
    }
     .input {
        height: 40px;
        width: 70%;
        border-radius: 7px;
        outline: none;
        border: 1px solid grey;
        padding: 0 10px;
    }
    .display{
        display: flex;

    }
    .button{
        background: rgb(0, 200, 0);
        border: none;
        padding: 2%;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        transition: background .3s;
    }
    .button:hover{ 
        background: rgb(0, 60, 0);
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="form-title">Verification Code</h1>

        <form method="POST">
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
                   <div class="display">
                   <input type="text" class="input" name="verification_code" placeholder="Enter verification code" required /> &nbsp;&nbsp;&nbsp;
                <input type="submit" class="button" name="verify_email" value="Verify Email">
                   </div>
        </form>
    </div>

</body>

</html>