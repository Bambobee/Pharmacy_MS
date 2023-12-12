<?php
include 'configaration.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:../login.php');
   exit(); // Added exit() to prevent further execution
}

if (isset($_GET['logout'])) {
   unset($_SESSION['user_id']); // Changed $user_id to $_SESSION['user_id']
   session_destroy();
   header('location:../login.php');
   exit(); // Added exit() to prevent further execution
}

require 'config/config.php';

if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];
  
    $tprice = $qty * $pprice;
  
    $stmt = $conn->prepare("UPDATE tbl_cart SET qty=?, total_price=? WHERE id=? AND user_id = $user_id");
    $stmt->bind_param("isi", $qty, $tprice, $pid);
    $stmt->execute();
  }