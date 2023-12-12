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

if(isset($_POST['pid'])){
    $pid = $_POST['pid'];
    $uid = $_POST['uid'];
    $pimage = $_POST['pimage'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pcode = $_POST['pcode'];
    $pqty = 1;

    $stmt = $conn->prepare("SELECT batch, user_id FROM tbl_cart WHERE batch=? AND user_id=?");
    $stmt->bind_param('ss', $pcode, $user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['batch'] ?? null;
    $fetchedUserId = $r['user_id'] ?? null;

    if(!$code || $fetchedUserId != $user_id){
        $query = $conn->prepare("INSERT INTO tbl_cart (name, price, image, qty, total_price, batch, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("sssisss", $pname, $pprice, $pimage, $pqty, $pprice, $pcode, $uid);
        $query->execute();

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Item added to the cart.</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Item already added to the cart.</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
 if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item'){
   $stmt = $conn->prepare("SELECT * FROM tbl_cart WHERE user_id = $user_id");
   $stmt->execute();
   $stmt->store_result();
   $rows = $stmt->num_rows;

   echo $rows;
 }
 

 if(isset($_GET['remove'])){
  $id = $_GET['remove'];

  $stmt = $conn->prepare("DELETE FROM tbl_cart  WHERE id=? AND user_id = $user_id");
  $stmt->bind_param("i",$id);
  $stmt->execute();
  
  $_SESSION['showAlert'] = 'block';
  $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Medicine has been removed from the cart successfully!</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  header('location:cart.php');
}

 if(isset($_GET['clear'])){
   $stmt=$conn->prepare("DELETE FROM tbl_cart WHERE user_id = $user_id");
   $stmt->execute();

   $_SESSION['showAlert'] = 'block';
   $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>All Items removed from the cart successfully!</strong> 
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';
   header('location:cart.php');
 }



function good_data($data){
  $result = trim($data);
  $result = htmlentities($data);
  $result = htmlspecialchars($data);
  $result = stripcslashes($data);
  return $result;
}
if(isset($_POST['action']) && isset($_POST['action']) == 'order'){
  $name = good_data($_POST['name']);
  $email = good_data($_POST['email']);
  $contact = good_data($_POST['contact']);
  $products = good_data($_POST['products']);
  $grand_total = good_data($_POST['grand_total']);
  $address = good_data($_POST['address']);
  $pmode = $_POST['pmode'];
  $image = $_POST['image'];

  $data = '';
  $stmt = $conn->prepare("INSERT INTO tbl_orders (name,email,contact,address,pmode,image,products,amount_paid) 
  VALUES(?,?,?,?,?,?,?,?)");
  $stmt->bind_param("ssssssss",$name,$email,$contact,$address,$pmode,$image,$products,$grand_total);
  $stmt->execute();
  $data .= '<div class="text-center">
              <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
              <h2 class="text-success">Your Order Placed Successfully!</h2>
              <h4 class="bg-danger text-light rounded p-2">Item Purchased : '.$products.'</h4>
              <h4>Your Name : '.$name.'</h4>
              <h4>Your Email : '.$email.'</h4>
              <h4>Your Phone : '.$contact.'</h4>
              <h4>Total Amount Paid : '.number_format($grand_total,2).'</h4>
              <h4>Payment Mode : '.$pmode.'</h4>
            </div>';  
  echo $data;  
  }       


?>