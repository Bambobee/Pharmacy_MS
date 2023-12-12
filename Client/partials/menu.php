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
                        <p  style="margin-bottom: 1rem;">Hey, <b><?php echo $fetch['name']; ?></b></p>
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
                            <input style="color: var(--color-dark);" class="sendMessage" name="name" type="text" value="<?php echo $fetch['name']; ?>" required>
                            <input type="hidden" name="image" value="<?= $fetch['image']; ?>">
                            <textarea class="sendMessages" rows="5" name="message" placeholder="Enter your message here..." required></textarea>
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
