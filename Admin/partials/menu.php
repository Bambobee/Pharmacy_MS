<?php include("config/constant.php"); ?>
<?php

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../Admin_login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:../Admin_login.php');
}

?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />

</head>

<body>
    <!-- MARKUP FOR SIDEBAR -->
    <section id="sidebar">
        <!-- <a href="#" class="brand"><i class="bx bxs-smile icon"></i>AdminSite</a> -->
        <div class="logo brand">
            <img class="icon" src="image/images.png">
            <h2 class="h2">PHAR<span class="danger">MACY</span></h2>
        </div>
        <div class="sidebar">
            <a href="<?php echo SITEURL; ?>index.php" class="act">
                <span><i class="bx bxs-dashboard"></i></span>
                <h3 class="h3">Dashboard</h3>
            </a>
            <a href="<?php echo SITEURL; ?>orders.php" class="act">
                <span><i class="bx bx-basket"></i></span>
                <h3 class="h3">Orders</h3>
                <?php
                    $sql1 = "SELECT * FROM tbl_orders WHERE status = 'order'";
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_num_rows($res1);
                    ?>
                <span class="message-count"><?= $count1; ?></span>
            </a>
            <a href="<?php echo SITEURL; ?>sales_report.php" class="act">
                <span><i class="bx bxs-report"></i></span>
                <h3 class="h3">Sale's Report</h3>
            </a>
            <a href="<?php echo SITEURL; ?>chart.php">
                <span><i class="bx bx-line-chart"></i></span>
                <h3 class="h3">graphs</h3>
            </a>
            <a href="<?php echo SITEURL; ?>purchase.php" class="act">
                <span><i class="bx bx-purchase-tag"></i></span>
                <h3 class="h3">purchase</h3>
            </a>
            <a href="<?php echo SITEURL; ?>customer.php" class="act">
                <span><i class="bx bx-user"></i></span>
                <h3 class="h3">Customers</h3>
            </a>
            <a href="<?php echo SITEURL; ?>invoice.php" class="act">
                <span><i class="bx bx-receipt"></i></span>
                <h3 class="h3">Invoice</h3>
            </a>
            <a href="<?php echo SITEURL; ?>Medicine-stock.php" class="act">
                <span><i class="bx bx-store"></i></span>
                <h3 class="h3">Medicine Stock</h3>
            </a>
            <a href="<?php echo SITEURL; ?>Expired.php" class="act">
                <span><i class="bx bx-calendar-x"></i></span>
                <h3 class="h3">Expired Stock</h3>
                <?php
                    $sql1 = "SELECT * FROM tbl_medicine_stock WHERE expiry <= NOW()";
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_num_rows($res1);
                    ?>
                <span class="message-count"><?= $count1; ?></span>
            </a>
            <a href="<?php echo SITEURL; ?>Out_of_stock.php" class="act">
                <span><i class="bx bx-store-alt"></i></span>
                <h3 class="h3">Out_of_stock</h3>
                <?php
                        //sql query
                        $sql = "SELECT * FROM tbl_medicine_stock WHERE quantity=0";
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count row
                        $count = mysqli_num_rows($res);                
                        ?>
                <span class="message-count"><?= $count; ?></span>
            </a>
            <a href="<?php echo SITEURL; ?>Category.php" class="act">
                <span><i class="bx bx-category-alt"></i></span>
                <h3 class="h3">Categories</h3>
            </a>
            <a href="<?php echo SITEURL; ?>Medicine.php" class="act">
                <span><i class="bx bx-capsule"></i></span>
                <h3 class="h3">Medicine</h3>
            </a>
            <a href="<?php echo SITEURL; ?>supplier.php" class="act">
                <span><i class='bx bxl-shopify'></i></span>
                <h3 class="h3">Supplier</h3>
            </a>

            <a href="<?php echo SITEURL; ?>Message.php" class="act">
                <span><i class="bx bxs-envelope"></i></span>
                <h3 class="h3">Messages</h3>
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
                <a href="message.php" class="nav-link">
                    <!---envelop-->
                    <?php
                        //sql query
                        $sql = "SELECT * FROM tbl_message WHERE status='Read'";
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count row
                        $count = mysqli_num_rows($res);                
                        ?>
                    <span><i class="bx bx-envelope icon"></i></span>
                    <span class="badge"><?= $count; ?></span>
                </a>

                <span class="divider"></span>

                <div class="theme-toggler">
                    <!-- <span class="material-icons-sharp active">light_mode</span> -->
                    <span class="active"><i class="bx bx-sun"></i></span>
                    <!-- <span class="material-icons-sharp">dark_mode</span> -->
                    <span><i class="bx bx-moon"></i></span>
                </div>
                <div class="profile">
                    <?php
                    $select = mysqli_query($conn, "SELECT * FROM `tbl_admin` WHERE id = '$user_id'") or die('query failed');
                    if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                    }
                   
                ?>
                    <div class="info">
                        <p style="margin-bottom: 1rem;">Hey, <b><?php echo $fetch['name']; ?></b></p>
                        <small class="text-muted1">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <?php
                    if($fetch['image'] == ''){
                        echo '<img src="./image/default-avatar.png">';
                    }else{
                        echo '<img src="Admin_images/'.$fetch['image'].'">';
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
                    <div class="recent-updates">
                        <h2 class="h2">Recent-Updates</h2>
                        <div class="updates">
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM tbl_orders WHERE status = 'Delivered' LIMIT 3");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()) {
                                    $image = '';
                                    if ($row["image"] != '') {
                                        $image = '<img src="../image/'.$row["image"].'" />';
                                    } else {
                                        $image = '<img src="image/default-avatar.png">';
                                    }
                                ?>
                            <div class="update">
                                <div class="profile-photo">
                                    <?= $image ?>
                                </div>
                                <div class="message">
                                    <p><b><?= $row['name'] ?></b> recieved his order of
                                        <?= substr($row['products'], 0, 30)?> .</p>
                                    <small class="text-muted1"> on <?= $row['date'] ?></small>
                                </div>
                            </div>
                            <hr>
                            <?php } ?>
                        </div>

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