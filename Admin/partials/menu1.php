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

<?php
  //invoice.php  
  include('database_connection.php');

  $statement = $connect->prepare("
    SELECT * FROM tbl_order 
    ORDER BY order_id DESC
  ");

  $statement->execute();

  $all_result = $statement->fetchAll();

  $total_rows = $statement->rowCount();

  if(isset($_POST["create_invoice"]))
  { 
    $order_total_before_tax = 0;
    $order_total_tax1 = 0;
    $order_total_tax2 = 0;
    $order_total_tax = 0;
    $order_total_after_tax = 0;
    $statement = $connect->prepare("
      INSERT INTO tbl_order 
        ( payment_method, order_date, order_receiver_address, order_total_before_tax, order_total_tax1, order_total_tax2, order_total_tax, order_total_after_tax, order_datetime)
        VALUES ( :payment_method, :order_date, :order_receiver_address, :order_total_before_tax, :order_total_tax1, :order_total_tax2, :order_total_tax, :order_total_after_tax, :order_datetime)
    ");
    $statement->execute(
      array(
          ':payment_method'               =>  trim($_POST["payment_method"]),
          ':order_date'             =>  trim($_POST["order_date"]),
          ':order_receiver_address'       =>  trim($_POST["order_receiver_address"]),
          ':order_total_before_tax'       =>  $order_total_before_tax,
          ':order_total_tax1'           =>  $order_total_tax1,
          ':order_total_tax2'           =>  $order_total_tax2,
          ':order_total_tax'            =>  $order_total_tax,
          ':order_total_after_tax'        =>  $order_total_after_tax,
          ':order_datetime'           =>  date("Y-m-d")
      )
    );

      $statement = $connect->query("SELECT LAST_INSERT_ID()");
      $order_id = $statement->fetchColumn();

      for($count=0; $count<$_POST["total_item"]; $count++)
      {
        $order_total_before_tax = $order_total_before_tax + floatval(trim($_POST["order_item_actual_amount"][$count]));

        $order_total_tax1 = $order_total_tax1 + floatval(trim($_POST["order_item_tax1_amount"][$count]));

        $order_total_tax2 = $order_total_tax2 + floatval(trim($_POST["order_item_tax2_amount"][$count]));

        $order_total_after_tax = $order_total_after_tax + floatval(trim($_POST["order_item_final_amount"][$count]));

        $statement = $connect->prepare("
          INSERT INTO tbl_order_item 
          (order_id, item_name, order_item_quantity, order_item_price, order_item_actual_amount, order_item_tax1_rate, order_item_tax1_amount, order_item_tax2_rate, order_item_tax2_amount, order_item_final_amount)
          VALUES (:order_id, :item_name, :order_item_quantity, :order_item_price, :order_item_actual_amount, :order_item_tax1_rate, :order_item_tax1_amount, :order_item_tax2_rate, :order_item_tax2_amount, :order_item_final_amount)
        ");

        $statement->execute(
          array(
            ':order_id'               =>  $order_id,
            ':item_name'              =>  trim($_POST["item_name"][$count]),
            ':order_item_quantity'          =>  trim($_POST["order_item_quantity"][$count]),
            ':order_item_price'           =>  trim($_POST["order_item_price"][$count]),
            ':order_item_actual_amount'       =>  trim($_POST["order_item_actual_amount"][$count]),
            ':order_item_tax1_rate'         =>  trim($_POST["order_item_tax1_rate"][$count]),
            ':order_item_tax1_amount'       =>  trim($_POST["order_item_tax1_amount"][$count]),
            ':order_item_tax2_rate'         =>  trim($_POST["order_item_tax2_rate"][$count]),
            ':order_item_tax2_amount'       =>  trim($_POST["order_item_tax2_amount"][$count]),
            ':order_item_final_amount'        =>  trim($_POST["order_item_final_amount"][$count])
          )
        );
      }
      $order_total_tax = $order_total_tax1 + $order_total_tax2;

      $statement = $connect->prepare("
        UPDATE tbl_order 
        SET order_total_before_tax = :order_total_before_tax, 
        order_total_tax1 = :order_total_tax1, 
        order_total_tax2 = :order_total_tax2, 
        order_total_tax = :order_total_tax, 
        order_total_after_tax = :order_total_after_tax 
        WHERE order_id = :order_id 
      ");
      $statement->execute(
        array(
          ':order_total_before_tax'     =>  $order_total_before_tax,
          ':order_total_tax1'         =>  $order_total_tax1,
          ':order_total_tax2'         =>  $order_total_tax2,
          ':order_total_tax'          =>  $order_total_tax,
          ':order_total_after_tax'      =>  $order_total_after_tax,
          ':order_id'             =>  $order_id
        )
      );
      header("location:invoice.php");
  }

  if(isset($_POST["update_invoice"]))
  {
    $order_total_before_tax = 0;
      $order_total_tax1 = 0;
      $order_total_tax2 = 0;
      $order_total_tax = 0;
      $order_total_after_tax = 0;
      
      $order_id = $_POST["order_id"];
      
      
      
      $statement = $connect->prepare("
                DELETE FROM tbl_order_item WHERE order_id = :order_id
            ");
            $statement->execute(
                array(
                    ':order_id'       =>      $order_id
                )
            );
      
      for($count=0; $count<$_POST["total_item"]; $count++)
      {
        $order_total_before_tax = $order_total_before_tax + floatval(trim($_POST["order_item_actual_amount"][$count]));
        $order_total_tax1 = $order_total_tax1 + floatval(trim($_POST["order_item_tax1_amount"][$count]));
        $order_total_tax2 = $order_total_tax2 + floatval(trim($_POST["order_item_tax2_amount"][$count]));
        $order_total_after_tax = $order_total_after_tax + floatval(trim($_POST["order_item_final_amount"][$count]));
        $statement = $connect->prepare("
          INSERT INTO tbl_order_item 
          (order_id, item_name, order_item_quantity, order_item_price, order_item_actual_amount, order_item_tax1_rate, order_item_tax1_amount, order_item_tax2_rate, order_item_tax2_amount, order_item_final_amount) 
          VALUES (:order_id, :item_name, :order_item_quantity, :order_item_price, :order_item_actual_amount, :order_item_tax1_rate, :order_item_tax1_amount, :order_item_tax2_rate, :order_item_tax2_amount, :order_item_final_amount)
        ");
        $statement->execute(
          array(
            ':order_id'                 =>  $order_id,
            ':item_name'                =>  trim($_POST["item_name"][$count]),
            ':order_item_quantity'          =>  trim($_POST["order_item_quantity"][$count]),
            ':order_item_price'            =>  trim($_POST["order_item_price"][$count]),
            ':order_item_actual_amount'     =>  trim($_POST["order_item_actual_amount"][$count]),
            ':order_item_tax1_rate'         =>  trim($_POST["order_item_tax1_rate"][$count]),
            ':order_item_tax1_amount'       =>  trim($_POST["order_item_tax1_amount"][$count]),
            ':order_item_tax2_rate'         =>  trim($_POST["order_item_tax2_rate"][$count]),
            ':order_item_tax2_amount'       =>  trim($_POST["order_item_tax2_amount"][$count]),
            ':order_item_final_amount'      =>  trim($_POST["order_item_final_amount"][$count])
          )
        );
        $result = $statement->fetchAll();
      }
      $order_total_tax = $order_total_tax1 + $order_total_tax2;
      
      $statement = $connect->prepare("
        UPDATE tbl_order 
        SET  
        payment_method = :payment_method,  
        order_date = :order_date,  
        order_receiver_address = :order_receiver_address, 
        order_total_before_tax = :order_total_before_tax, 
        order_total_tax1 = :order_total_tax1, 
        order_total_tax2 = :order_total_tax2, 
        order_total_tax = :order_total_tax, 
        order_total_after_tax = :order_total_after_tax 
        WHERE order_id = :order_id 
      ");
      
      $statement->execute(
        array(
          ':order_date'             =>  trim($_POST["order_date"]),
          ':payment_method'             =>  trim($_POST["payment_method"]),
          ':order_receiver_address'     =>  trim($_POST["order_receiver_address"]),
          ':order_total_before_tax'     =>  $order_total_before_tax,
          ':order_total_tax1'          =>  $order_total_tax1,
          ':order_total_tax2'          =>  $order_total_tax2,
          ':order_total_tax'           =>  $order_total_tax,
          ':order_total_after_tax'      =>  $order_total_after_tax,
          ':order_id'               =>  $order_id
        )
      );
      
      $result = $statement->fetchAll();
            
      header("location:invoice.php");
  }

  if(isset($_GET["delete"]) && isset($_GET["id"]))
  {
    $statement = $connect->prepare("DELETE FROM tbl_order WHERE order_id = :id");
    $statement->execute(
      array(
        ':id'       =>      $_GET["id"]
      )
    );
    $statement = $connect->prepare(
      "DELETE FROM tbl_order_item WHERE order_id = :id");
    $statement->execute(
      array(
        ':id'       =>      $_GET["id"]
      )
    );
    header("location:invoice.php");
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
    <script src="./jquery/jquery-3.6.1.min.js"></script>
    <script src="./jquery/jquery.validate.min.js"></script>
    <script src="./assets/datatables.min.js"></script>
    <script src="./assets/pdfmake.min.js"></script>
    <script src="./assets/vfs_fonts.js"></script>
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
        margin-bottom: 4px;
        border-radius: 0;
    }

    /* Add a gray background color and some padding to the footer */
    footer {
        background-color: #f2f2f2;
        padding: 25px;
    }

    .carousel-inner img {
        width: 100%;
        /* Set width to 100% */
        margin: auto;
        min-height: 200px;
    }

    .navbar-brand {
        padding: 5px 40px;
    }

    .navbar-brand:hover {
        background-color: #ffffff;
    }

    /* Hide the carousel text when the screen is less than 600 pixels wide */
    @media (max-width: 600px) {
        .carousel-caption {
            display: none;
        }
    }
    </style>
</head>

<body>
    <style>
    .box {
        width: 100%;
        max-width: 1390px;
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 15px;
        margin: 0 auto;
        margin-top: 50px;
        box-sizing: border-box;
    }
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>

    <script>
    $(document).ready(function() {
        $('#order_date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
    </script>


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