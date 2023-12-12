<?php

require_once "config/Database.php";

function good_data($data){
    $result = trim($data);
    $result = htmlentities($data);
    $result = htmlspecialchars($data);
    $result = stripcslashes($data);
    return $result;
}

$name = good_data($_POST['name']);
$email = good_data($_POST['email']);
$contact = good_data($_POST['contact']);
$subject = good_data($_POST['subject']);
$message = good_data($_POST['message']);

try{ 
    $pdo = "INSERT INTO tbl_message(name, email,contact, subject, message) values('$name','$email','$contact','$subject','$message')";
    $conn->exec($pdo);
    echo "New record created successfully";
    } catch(PDOException $ex) {
    echo $pdo . "<br>" . $ex->getMessage();
    }
    $conn = null;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if(isset($_POST['send'])){
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $contact = htmlentities($_POST['contact']);
    $subject = htmlentities($_POST['subject']);
    $message = htmlentities($_POST['message']);

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rickrambo29@gmail.com';
    $mail->Password = 'phgtqljdlwsukzsx';
    $mail->Port = 465;
    // $mail->SMTPSecure = 'ssl';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->isHTML(true);
    $mail->setFrom($email, $contact, $name);
    $mail->addAddress('rickrambo29@gmail.com');
    $mail->Subject = ("$email ($subject)");
    $mail->Body = $message;
    $mail->send();

    if ($mail->send()) {
        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Message sent successfully!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        header("Location: ./message.php");
    }
    else{
        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Message Failed to send successfully!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        header("Location: ./message.php");
    }
    
}
?>
