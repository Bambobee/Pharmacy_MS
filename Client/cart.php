<?php
include 'configaration.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:../client-login.php');
   exit(); // Added exit() to prevent further execution
}

if (isset($_GET['logout'])) {
   unset($_SESSION['user_id']); // Changed $user_id to $_SESSION['user_id']
   session_destroy();
   header('location:../client-login.php');
   exit(); // Added exit() to prevent further execution
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
                        <form action="./blog.php" class="all-inputs">
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

            <div class="contain">
                <nav class="navbar navbar-expand-lg bg-light">
                    <div class="container bg-light">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo SITEURL; ?>shopping.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo SITEURL; ?>category.php">Category</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo SITEURL; ?>medicine.php">Medicine</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo SITEURL; ?>checkout.php">Checkout</a>
                                </li>
                                <li><a class="nav-link" href="<?php echo SITEURL; ?>Cart.php"><i
                                            class="bx bx-shopping-bag"></i>
                                        <span id="cart-item" class="badge badge-danger"></span></a></li>

                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="category-page page">
                    <h2 class="start">VIEW SELECTED ITEMS</h2>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">

                                <div style="display:<?php if(isset($_SESSION['showAlert'])){echo $_SESSION['showAlert'];}else{ echo 'none';}
     unset($_SESSION['showAlert']); ?>">
                                    <strong><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];} 
        unset($_SESSION['showAlert']); ?></strong>
                                </div>
                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <td colspan='7'>
                                                    <h4 class="text-center text-info m-0"> Medicine in your cart!</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>SN</th>
                                                <th>Image</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total Price</th>
                                                <th>
                                                    <a href="action.php?clear=all" class="btn-sm btn btn-danger p-1"
                                                        onclick="return confirm('Are sure you want to clear your cart?');"><i
                                                            class="bx bx-trash"></i>
                                                        &nbsp;&nbsp;Clear cart</a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM tbl_cart WHERE user_id = $user_id");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $grand_total = 0;
                                            while($row = $result->fetch_assoc()):
                                                $image = '';
                                                if ($row["image"] != '') {
                                                    $image = '<img width="50" src="../Admin/medicine_images/'.$row["image"].'" />';
                                                } else {
                                                    $image = '<div style="color: #ff4757;">Image not added.</div>';
                                                }
                                                $sn=1;
                                            ?>
                                            <tr>
                                                <td><?= $sn++; ?></td>

                                                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                                <td><?= $image ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><span>Ugshs</span>&nbsp;<?= number_format($row['price'],2) ?>/-</td>

                                                <input type="hidden" class="pprice" value="<?= $row['price'] ?> ">

                                                <td>

                                                    <input type="number" class="form-control itemQty"
                                                        value="<?= $row['qty']?>" style="width: 75px;">

                                                </td>
                                                <td><span>Ugshs</span>&nbsp;<?= number_format($row['total_price'],2) ?>/-
                                                </td>
                                                <td>
                                                    <a href="action.php?remove=<?= $row['id'] ?>"
                                                        class="text-danger lead">
                                                        <i class="bx bx-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php $grand_total += $row['total_price']; ?>
                                            <?php endwhile; ?>
                                            <tr>
                                                <td colspan="3">
                                                    <a href="medicine.php" class="btn btn-success"><i
                                                            class="bx bx-cart-plus"></i>
                                                        &nbsp;&nbsp;Continue Shopping</a>
                                                </td>
                                                <td colspan="2"><b>Grand Total</b></td>
                                                <td><b><span>Ugshs</span>&nbsp;<?= number_format($grand_total,2) ?>/-</b>
                                                </td>
                                                <td>
                                                    <a href="checkout.php"
                                                        class="btn btn-sm btn-info <?= ($grand_total>1)? "":"disabled"; ?>">
                                                        <i class="bx bx-credit-card"></i>
                                                        &nbsp;&nbsp;Checkout</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </div>
            </div>
        </main>
    </section>


    <!-- section for navigation bar ends here -->

    <!--Html for the footer-->
    <footer class="footer">
        <!-- <div class="hr"></div> -->
        <div class="last">
            <p>&copy;copyright all rights reserved by Ssewankambo Derick</p>
        </div>
    </footer>

    <script src="./jquery/jquery-3.6.1.min.js"></script>
    <script src="./jquery/jquery.validate.min.js"></script>
    <script src="./assets/datatables.min.js"></script>
    <script src="./assets/pdfmake.min.js"></script>
    <script src="./assets/vfs_fonts.js"></script>
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/dataTables.responsive.min.js"></script>
    <script src="./assets/sweetalert2@11.js"></script>
    <script src="./src/main.js"></script>
    <script src="./assets/java.js"></script>
    <script src="./assets/index.js"></script>


    <!-- Ajax for the add to cart button--->
    <script type="text/javascript">
    $(document).ready(function() {

        $(".itemQty").on('change', function() {
            var $el = $(this).closest('tr');
            var pid = $el.find(".pid").val();
            var pprice = $el.find(".pprice").val();
            var qty = $el.find(".itemQty").val();
            location.reload(true);
            
            $.ajax({
                url: 'action1.php',
                method: 'post',
                cache: false,
                data: {
                    qty: qty,
                    pid: pid,
                    pprice: pprice
                },
                success: function(response) {
                    console.log(response);
                }
            });
        });

        load_cart_item_number();

        function load_cart_item_number() {
            $.ajax({
                url: 'action.php',
                method: 'get',
                data: {
                    cartItem: "cart_item"
                },
                success: function(response) {
                    $("#cart-item").html(response);
                }
            })
        }
    });
    </script>
</body>

</html>