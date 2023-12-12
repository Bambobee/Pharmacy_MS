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
                        <form action="" class="all-inputs">
                            <?php
                      $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE id = '$user_id'") or die('query failed');
                      if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                      }
                  ?>
                            <input style="color: var(--color-dark);" class="sendMessage" type="text"
                                value="<?php echo $fetch['name']; ?>">
                            <input type="hidden">
                            <textarea class="sendMessages" rows="5" placeholder="Enter your message here..."></textarea>
                            <a href="#" class="send">Submit</a>
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
                <br><br>
                <?php 
$grand_total = 0;
$allItems = '';
$items = array();

$sql = "SELECT CONCAT(name, '(',qty,')') AS ItemQty, total_price FROM tbl_cart WHERE user_id = $user_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQty'];
}
$allItems = implode(", ",$items);
?>

                <div class="container">
                    <div class="row justify-content-center ">
                        <div class="col-lg-6 px-4 pb-4 " id="order">
                            <h4 class="text-center text-info p-2" style="font-size: 30px;">Complete your order!</h4>
                            <div class="jumbotron bg-info p-3 mb-2 text-center">
                                <h6 class="lead">
                                    <b>Product(s) : </b><?= $allItems; ?>
                                </h6>
                                <h6 class="lead">
                                    <b>Delivery Charges : </b>Free
                                </h6>
                                <h5>
                                    <b>Total Amount Payable :
                                    </b><span>Ugshs</span>&nbsp;&nbsp;<?= number_format($grand_total,2) ?>/-
                                </h5>
                            </div>
                            <form action="" method="post" id="placeOrder">

                                <input type="hidden" name="products" value="<?= $allItems; ?>">
                                <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                                <?php
                      $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE id = '$user_id'") or die('query failed');
                      if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                        $name = $fetch['name'];
                        $email = $fetch['email'];
                        $contact = $fetch['contact'];
                        $address = $fetch['address'];
                        $image = $fetch['image'];
                      }
                  ?>
                                <input type="hidden" name="image" value="<?= $image; ?>">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?= $name; ?>"
                                        required><br>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= $email; ?>"><br>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone number</label>
                                    <input type="tel" name="contact" class="form-control" value="<?= $contact; ?>"><br>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Delivery Address</label>
                                    <input type="text" name="address" class="form-control" value="<?= $address; ?>"><br>
                                </div>
                                <h6 class="text-center lead">Select Payment Mode</h6>
                                <div class="mb-3">
                                    <select name="pmode" class="form-select">
                                        <option value="" selected disabled>-Select Payment Mode-</option>
                                        <option value="cod">Cash On Delivery</option>
                                        <option value="netbanking">Net Banking</option>
                                        <option value="cards">Debit/Credit Card</option>
                                    </select><br>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" name="submit" value="place Order"
                                        class="btn btn-danger form-control btn-block">
                                </div>
                            </form>
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
    <script src="./src/main.js"></script>
    <script src="./assets/java.js"></script>
    <script src="./assets/index.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {

        $("#placeOrder").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'action.php',
                method: 'post',
                data: $('form').serialize() + "&action=order",
                success: function(response) {
                    $("#order").html(response);
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