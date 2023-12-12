<?php

include 'configaration.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../client-login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:../client-login.php');
}

?>

<?php include("config/config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin site</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/datatables.min.css">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/responsive.dataTables.min.css">
    <link rel="stylesheet" href="./assets/sweetalert.min.css">
    <style>
    *::-webkit-scrollbar {
        width: 0px;
    }

    .buttons {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .button {
        background: blue;
        display: flex;
        padding: 10px 15px;
        color: var(--color-white);
        border-radius: 20px;
    }

    .btn {
        width: 100%;
        border-radius: 5px;
        padding: 10px 30px;
        color: var(--color-white);
        display: block;
        text-align: center;
        cursor: pointer;
        font-size: 20px;
        margin-top: 10px;
    }

    .btn {
        background-color: var(--blue);
    }

    .message {
        margin: 10px 0;
        text-align: center;
        color: red;
        font-size: 18px;
    }

    form {
        padding: 20px;
        background-color: #ffffffa6;
        box-shadow: var(--box-shadow);
        text-align: center;
        /* width: 700px; */
        text-align: center;
        border-radius: 5px;
    }

    form img {
        height: 200px;
        width: 200px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 5px;
    }

    form .flex {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 15px;
    }

    form .flex .inputBox {
        width: 49%;
    }

    form .flex .inputBox span {
        text-align: left;
        display: block;
        margin-top: 15px;
        font-size: 17px;
        color: var(--black);
    }

    form .flex .inputBox .box {
        width: 100%;
        border-radius: 5px;
        background-color: var(--color-white);
        padding: 12px 14px;
        font-size: 17px;
        color: var(--color-dark);
        margin-top: 10px;
    }
    
    @media (max-width:650px) {
         form .flex {
            flex-wrap: wrap;
            gap: 0;
        }

         form .flex .inputBox {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <!-- MARKUP FOR SIDEBAR -->
    <section id="sidebar" class="hide">
        <!-- <a href="#" class="brand"><i class="bx bxs-smile icon"></i>AdminSite</a> -->
        <div class="logo brand">
            <img class="icon" src="image/images.png">
            <h2 class="h2">PHAR<span class="danger">MACY</span></h2>
        </div>
        <div class="sidebar">

            <a href="<?php echo SITEURL; ?>shopping.php" class="act">
                <span><i class="bx bx-cart"></i></span>
                <h3 class="h3">Shopping</h3>
            </a>
            <a href="<?php echo SITEURL; ?>category.php" class="act">
                <span><i class="bx bx-category-alt"></i></span>
                <h3 class="h3">Category</h3>
            </a>
            <a href="<?php echo SITEURL; ?>medicine.php" class="act">
                <span><i class="bx bx-capsule"></i></span>
                <h3 class="h3">medicine</h3>
            </a>
            <a href="<?php echo SITEURL; ?>Cart.php" class="act">
                <span><i class="bx bx-shopping-bag"></i></span>
                <h3 class="h3">Cart</h3>
            </a>
            <a href="<?php echo SITEURL; ?>checkout.php" class="act">
                <span><i class="bx bx-credit-card"></i></span>
                <h3 class="h3">Checkout</h3>
            </a>
            <a href="<?php echo SITEURL; ?>message.php" class="act">
                <span><i class="bx bx-message-dots"></i></span>
                <h3 class="h3">Send a Message</h3>
            </a>
            <a href="<?php echo SITEURL; ?>settings.php" class="act">
                <span><i class="bx bxs-cog"></i></span>
                <h3 class="h3">My Account</h3>
            </a>
            <a href="?logout=<?php echo $user_id; ?>">
                <span><i class="bx bx-log-out"></i></span>
                <h3 class="h3">Logout</h3>
            </a>
        </div>
    </section>
    <!-- END OF MARKUP FOR SIDEBAR -->

    <!-- section for navigation bar starts here -->
    <section id="content">
        <!-- navbar -->
        <nav>
            <div class="push-left"> <i class="bx bx-menu toggle-sidebar"> </i></div>

            <div class="top">

                <span class="divider"></span>

                <div class="theme-toggler">
                    <!-- <span class="material-icons-sharp active">light_mode</span> -->
                    <span class="active"><i class="bx bx-sun"></i></span>
                    <!-- <span class="material-icons-sharp">dark_mode</span> -->
                    <span><i class="bx bx-moon"></i></span>
                </div>

                <div class="profile">
                    <?php
                    $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE id = '$user_id'") or die('query failed');
                    if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                    }
                   
                ?>
                    <div class="info">
                        <p style="margin-bottom: 1rem;">Hey, <b><?php echo $fetch['name']; ?></b></p>
                        <small class="text-muted1">Client</small>
                    </div>
                    <div class="profile-photo">
                        <?php
                    if($fetch['image'] == ''){
                        echo '<img src="image/default-avatar.png">';
                    }else{
                        echo '<img src="uploaded_img/'.$fetch['image'].'">';
                    }
                    ?>
                    </div>
                </div>

            </div>
        </nav>
        <!-- navbar -->

        <!-- MAIN -->
        <main>
            <div class="rightbar close">
                <header>
                    <i class="bx bx-chevron-left toggle"></i>
                </header>
                <div class="contain1">
                    <div class="complain">
                        <h2 style="font-size: 1.1rem;" class="text-center p-2">Comment on our services.</h2>
                        <form action="./blog.php" method="post" class="all-inputs">
                            <?php
                      $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE id = '$user_id'") or die('query failed');
                      if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                      }
                  ?>
                            <input style="color: var(--color-dark);" class="sendMessage" name="name" type="text"
                                value="<?php echo $fetch['name']; ?>" required>
                            <input type="hidden" name="image" value="<?= $fetch['image']; ?>">
                            <textarea class="sendMessages" rows="5" name="message"
                                placeholder="Enter your message here..." required></textarea>
                            <button type="submit" name="send" class="send">Submit</button>
                        </form>
                    </div>
                    <div class="body light">
                        <!-- <h2 class="h2">Calendar</h2> -->
                        <div class="calendar light">
                            <div class="calendar-header">
                                <span class="month-picker" id="month-picker">
                                    March
                                </span>
                                <div class="year-picker">
                                    <span class="year-change" id="prev-year">
                                        <pre><i class="bx bx-chevron-left"></i></pre>
                                    </span>
                                    <span id="year">2023</span>
                                    <span class="year-change" id="next-year">
                                        <pre><i class="bx bx-chevron-right"></i></pre>
                                    </span>
                                </div>
                            </div>

                            <div class="calendar-body">
                                <div class="calendar-week-day">
                                    <div>Sun</div>
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thur</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                                <div class="calendar-days">
                                    <div>
                                        1
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div>2</div>
                                    <div>3</div>
                                    <div>4</div>
                                    <div>5</div>
                                    <div>6</div>
                                    <div>7</div>
                                    <div>1</div>
                                    <div>2</div>
                                    <div>3</div>
                                    <div>4</div>
                                    <div>5</div>
                                    <div>6</div>
                                    <div>7</div>
                                </div>
                            </div>

                            <div class="month-list"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="profiles">
                <h2 class="start">View Your Profile</h2><br>
                <?php
                if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
         ?>
                <div class="Profile-info">
                    <center>
                        <div class="profile-pic">
                            <?php
         $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img class="picture" src="images/default-avatar.png">';
         }else{
            echo '<img class="picture" src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
                        </div>
                    </center>
                    <div class="profile-data">
                        <p>Name :&nbsp;<?php echo $fetch['name']; ?></p>
                        <p>Email :&nbsp;<?php echo $fetch['email']; ?></p>
                        <p>Contact :&nbsp;<?php echo $fetch['contact']; ?></p>
                        <p>Address :&nbsp;<?php echo $fetch['address']; ?></p>
                        <div class="buttons">
                            <button type="button" id="add_button" class="mt-4 button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Update your profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php

include 'configaration.php';
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_contact = mysqli_real_escape_string($conn, $_POST['update_contact']);
   $update_address = mysqli_real_escape_string($conn, $_POST['update_address']);

   mysqli_query($conn, "UPDATE `tbl_users` SET 
   name = '$update_name', email = '$update_email',contact = '$update_contact', address = '$update_address' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `tbl_users` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `tbl_users` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }

}

?>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" style="display: flex;">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
        
      ?>
                            <div class="flex">
                                <div class="inputBox">
                                    <span>username :</span>
                                    <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>"
                                        class="box">
                                    <span>your email :</span>
                                    <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>"
                                        class="box">
                                    <span>your contact :</span>
                                    <input type="tel" name="update_contact" value="<?php echo $fetch['contact']; ?>"
                                        class="box">
                                    <span>update your pic :</span>
                                    <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png"
                                        class="box">

                                </div>
                                <div class="inputBox">
                                    <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
                                    <span>old password :</span>
                                    <input type="password" name="update_pass" placeholder="enter previous password"
                                        class="box">
                                    <span>new password :</span>
                                    <input type="password" name="new_pass" placeholder="enter new password" class="box">
                                    <span>confirm password :</span>
                                    <input type="password" name="confirm_pass" placeholder="confirm new password"
                                        class="box">
                                    <span>your address :</span>
                                    <input type="text" name="update_address" value="<?php echo $fetch['address']; ?>"
                                        class="box">
                                    <input type="submit" value="update profile" name="update_profile" class="btn">
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
            <?php include("./partials/footer.php"); ?>