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

            <a href="shopping.php" class="act">
                <span><i class="bx bx-cart"></i></span>
                <h3 class="h3">Shopping</h3>
            </a>
            <a href="category.php" class="act">
                <span><i class="bx bx-category-alt"></i></span>
                <h3 class="h3">Category</h3>
            </a>
            <a href="medicine.php" class="act">
                <span><i class="bx bx-capsule"></i></span>
                <h3 class="h3">medicine</h3>
            </a>
            <a href="Cart.php" class="act">
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
            <a href="#">
                <span><i class="bx bxs-cog"></i></span>
                <h3 class="h3">Settings</h3>
            </a>

            <a href="log_out.php">
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
                    <div class="info">
                        <p style="margin-bottom: 1rem;">Hey, <b>Ssewankambo Derick</b></p>
                        <small class="text-muted1">Client</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./image/face girl.jpg">
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
                                    <a class="nav-link" href="shopping.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="category.php">Category</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="medicine.php">Medicine</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo SITEURL; ?>checkout.php">Checkout</a>
                                </li>
                                <li><a class="nav-link" href="Cart.php"><i class="bx bx-shopping-bag"></i>
                                        <span id="cart-item" class="badge badge-danger"></span></a></li>
                            </ul>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            </form>
                        </div>
                    </div>
                </nav><br><br>
                <div id="message"></div>
                <div class="category-medicine page">
                    <?php
                if(isset($_GET['category'])){
                    $category_id = mysqli_real_escape_string($conn, $_GET['category']);
                    $sql = "SELECT name FROM tbl_category WHERE id='$category_id'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);
                    if(!$row) {
                        header('location:'.SITEURL.'category.php');
                        exit;
                    }
                }
            ?>
                    <h2 class="start">MEDICINE IN "<?= htmlspecialchars($row['name']) ?>"</h2>
                    <p style="text-align: center; font-size: 15px;">Try to search for the medicine you want.</p>
                    <div class="combines">
                        <?php
                $stmt = $conn->prepare("SELECT * FROM tbl_medicine WHERE category=$category_id");
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    $image = '';
                    if ($row["image"] != '') {
                        $image = '<img style="width: 100%; height: 100%; border-radius: var(--card-border-radius);" src="../Admin/medicine_images/'.$row["image"].'" />';
                    } else {
                        $image = '<div style="color: #ff4757;">Image not added.</div>';
                    }
                ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?= $image ?>
                            </div>
                            <div class="food-menu-desc">
                                <h4><?= $row['name'] ?></h4>
                                <div class="price">
                                    <p class="food-price">Price : </p> &nbsp;
                                    <p class="food-price">UgShs <?= number_format($row['price'], 2) ?>/-</p>
                                </div>
                                <p class="food-detail"><?= substr($row['description'], 0, 5) ?></p>
                                <br>
                                <div class="treat">
                                    <form action="" class="form-submit">
                                        <input type="hidden" class="pid" value="<?= $row['id']; ?>">
                                        <input type="hidden" class="uid" value=" <?php echo $user_id; ?>">
                                        <input type="hidden" class="pname" value="<?= $row['name']; ?>">
                                        <input type="hidden" class="pimage" value="<?= $row['image']; ?>">
                                        <input type="hidden" class="pprice" value="<?= $row['price']; ?>">
                                        <input type="hidden" class="pcode" value="<?= $row['batch']; ?>">
                                        <button style="padding-top: 10px;" class="together btn-sm addItemBtn"><i
                                                class="bx bx-cart-alt"></i>&nbsp;Add to cart</button>
                                    </form>
                                    <button style="padding-top: -8px;" class="together viewItem btn-sm"
                                        id="<?= $row['id']; ?>"><i class="bx bx-show"></i>&nbsp;View</button>
                                </div>

                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <!-- Modal Body -->
            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" id="userModal">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div Style="border-radius: 5px; background: #fff;" class="modal-content">
                        <div class="modal-body">


                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN -->
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
    <script src="./assets/java.js"></script>
    <script src="./assets/index.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $(".addItemBtn").click(function(e) {
            e.preventDefault();
            var $form = $(this).closest(".form-submit");
            var pid = $form.find(".pid").val();
            var uid = $form.find(".uid").val();
            var pname = $form.find(".pname").val();
            var pimage = $form.find(".pimage").val();
            var pprice = $form.find(".pprice").val();
            var pcode = $form.find(".pcode").val();

            $.ajax({
                url: 'action.php',
                method: 'post',
                data: {
                    pid: pid,
                    uid: uid,
                    pname: pname,
                    pimage: pimage,
                    pprice: pprice,
                    pcode: pcode
                },
                success: function(response) {
                    $("#message").html(response);
                    window.scrollTo(0, 0);
                    load_cart_item_number();
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

    $('.viewItem').click(function() {
        med_id = $(this).attr('id')
        $.ajax({
            url: 'select.php',
            method: 'post',
            data: {
                id_med: med_id
            },
            success: function(result) {
                $(".modal-body").html(result);
            }
        });
        $('#userModal').modal('show');
    })
    </script>
</body>

</html>