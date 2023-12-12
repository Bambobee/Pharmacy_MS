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
$image = $_POST['image'];
$message = good_data($_POST['message']);

try{ 
    $pdo = "INSERT INTO tbl_blog(name, image, message) values('$name','$image','$message')";
    $conn->exec($pdo);
    echo "New record created successfully";
    } catch(PDOException $ex) {
    echo $pdo . "<br>" . $ex->getMessage();
    }
    $conn = null;
    header("Location: ./shopping.php");