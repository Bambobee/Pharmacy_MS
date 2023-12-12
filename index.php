<?php include("./Client/config/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./swiper-bundle.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="./aos.css">
</head>
<body>
    <header>
        <div class="parent" >
            <nav>
                <ul class="child-1">
                    <li><a href="mailto:info@gamil.com"><i class="fa fa-envelope"></i>&nbsp;info@gmail.com</a></li>
                    <li><a href="tel:+256 756856058"><i class="fa fa-phone"></i>&nbsp;+256 758656058</a></li>
                    <li><a href="./Admin_login.php"><i class="fa fa-user"></i>&nbsp;Login</a></li>     
                </ul>
            </nav>
            <hr>
            <nav class="navbar">
                <div class="fix">
                    <i class="fa fa-bars left_bar"></i>&nbsp;
                    <div class="logo">
                        <img width="100%" src="./image/images.png" alt="">
                    </div>
                    <div><p class="name">PHAR<span>MACY</span></p></div>
                </div>
                <ul class="child-2">
                    <li><a class="link" href="#">home</a></li>
                    <li><a class="link" href="#about">about</a></li>
                    <li><a class="link" href="./client-login.php">shop</a></li>
                    <li><a class="link" href="#stock">New Stock</a></li>
                    <li><a class="link" href="#contact">contact</a></li>
                    <li><a class="link" href="#blog">Testimonies</a></li>
                    <li><a class="link" href="./client-login.php">Sign In</a></li>
                </ul>
            </nav>
        </div>

            <div class="text" data-aos="zoom-out" data-aous-duration="4500">
                <h1 class="head">
                    WE ARE HERE TO HELP.
                </h1>
                <p class="para">
                    To make you have a healthy life and dream about the perfect one. <br>
                    Create an account with us to get a greater user experience.
                </p>
                <br>
                <a class="button" href="./client-login.php">Sign In</a>
            </div>
    </header>
     <main>
        <div class="main">
            <h2 class="title" data-aos="fade-up" data-aous-duration="4000">MOST POPULAR CATEGORIES</h2>
            <br><br>
            <div class="category" data-aos="zoom-in" data-aous-duration="5000">
            <?php
                $stmt = $conn->prepare("select * from tbl_category WHERE active='Yes' && featured = 'Yes' limit 3;");
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()):
                    $image = '';
                    if ($row["image"] != '') {
                        $image = '<img class="image" width="100%" height="300px" src="./Admin/Category_images/' . $row["image"] . '" />';
                    } else {
                        $image = '<div style="color: #ff4757;">Image not Added.</div>';
                    }
                ?>
                    <a href="#">
                       <?= $image; ?>
                        <p class="category_name"><?= $row['name'] ?></p>
                </a>
                    <?php endwhile; ?> 
            </div>
        </div>
        <div id="about">
            <div class="main-about">
                <div class="inner" data-aos="zoom-out-down" data-aous-duration="2000">
                    <div class="about-content">
                        <h1>About us</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste nemo sed unde. Maiores sequi recusandae repellendus sint aspernatur dolorem doloremque ullam magnam accusamus. Pariatur illum temporibus quo nihil neque expedita?</p>
                    <br>
                    <a class="button" href="./client-login.php">Contact Us</a>
                    </div>
                </div>
    
                <div class="inner-about" data-aos="fade-in" data-aous-duration="1500">
                    <div class="inner-about-image">
                        <img width="100%" src="./image/no4.webp" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="main " id="stock">
            <h2 class="title" data-aos="fade-up" data-aous-duration="1500">NEW ARRIVALS</h2>
            <br><br>
            <div class="slide-container">
                <i class="fa fa-chevron-left icon" id="slide-left"></i>
    
                <section class="containers" id="slider" data-aos="zoom-out-up" data-aous-duration="2000">
                    <?php
                                 $stmt = $conn->prepare("select * from tbl_medicine WHERE active='Yes' && featured = 'Yes' limit 25;");
                                 $stmt->execute();
                                 $result = $stmt->get_result();
                                 while($row = $result->fetch_assoc()):
                                     $image = '';
                                     if ($row["image"] != '') {
                                         $image = '<img width="250px" height="200px" src="./Admin/medicine_images/' . $row["image"] . '" />';
                                     } else {
                                         $image = '<div style="color: #ff4757;">Image not Added.</div>';
                                     }
                                 ?>

                            <div class="thumbnail">
                                <div class="font">
                                <?= $image; ?>
                                    <div class="product-detail">
                                        <h2><?= $row['name'] ?></h2>
                                    <p>Price : Ugshs <?= $row['price'] ?>/-</p>
                                    <button class="button viewItem"  id="<?= $row['id']; ?>">View</button>
                                    </div>
                                </div>
                                </div>
                                <?php endwhile; ?>
                   
                </section>    
                <i class="fa fa-chevron-right icon" id="slide-right"></i>
            </div>  
        </div>
        
        <div id="contact">
            <h2 class="title" data-aos="fade-up" data-aous-duration="1500">Find us on that location.</h2>
            <br>
            <div class="contain" id="for" data-aos="flip-up" data-aous-duration="3000">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.77760667445!2d32.509904914753356!3d0.2588400998111531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177da3d5b4e0ccd1%3A0x6b7f1e2faec20979!2sKikajjo%20Sda%20High%20School!5e0!3m2!1sen!2sug!4v1654070273072!5m2!1sen!2sug" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

     
        <div class="slide-contain swiper" id="blog">
            <h2 class="title" data-aos="fade-up" data-aous-duration="1500">PEOPLE'S TESTIMONIES</h2>
            <div class="slide-content" data-aos="zoom-out-up" data-aous-duration="2000">
                <div class="card-wrapper swiper-wrapper" style="height: 400px">
                <?php
                $stmt = $conn->prepare("select * from tbl_blog limit 25;");
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()):
                    $image = '';
                    if ($row["image"] != '') {
                        $image = '<img class="card-img" src="./Client/uploaded_img/' . $row["image"] . '" />';
                    } else {
                        $image = '<div style="color: #ff4757;"><img class="card-img" src="./image/default-avatar.png" /></div>';
                    }
                ?>
                   <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
                            <?= $image; ?>
                            </div>
                        </div>
    
                        <div class="card-content">
                            <h2 class="name"><?= $row['name'] ?></h2>
                            <p class="description">
                            <?= substr($row['message'], 0, 100) ?>
                            </p>
                            <button class="button Viewblog" id="<?= $row['id']; ?>">View More</button>
                        </div>
                    </div>
                     
                    <?php endwhile; ?>
                </div>
            </div>
         
            <div class="swiper-button-next swiper-navbtn"></div>
            <div class="swiper-button-prev swiper-navbtn"></div>
            <div class="swiper-pagination"></div>
            
        </div>

        <div class="modal fade" id="userModal">
        <div Style="background: #fff;" class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div  Style="border-radius: 5px; background: #f6fff9;" class="modal-content">
                    <div class="modal-body">
     
                          
                    </div>
                </div>
        </div>
    </div>

    <div class="modal fade" id="Testimonies">
        <div Style="background: #fff;" class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div  Style="border-radius: 5px; background: #f6fff9;" class="modal-content">
                    <div class="modal-body">
     
                          
                    </div>
                </div>
        </div>
    </div>
</div>

        <div class="all">
            <div class="follow">
                <div class="big_logo" data-aos="zoom-out-down" data-aous-duration="2000">
                        <div class="logo">
                            <img width="100%" src="./image/images.png" alt="">
                        </div>
                        <div><p class="name">PHAR<span>MACY</span></p></div>
                    </div>
                <div class="read" data-aos="zoom-out-up" data-aous-duration="2000">  
                        <h1 class="heading">About us</h1>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste nemo sed unde. Maiores sequi recusandae repellendus sint aspernatur dolorem doloremque ullam magnam accusamus. Pariatur illum temporibus quo nihil neque expedita?</p>
                        </div>
                <div class="social" data-aos="zoom-out-down" data-aous-duration="2000">
                    <h1 class="heading">Follow us</h1>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                   <a href="#"> <i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </main>
     <footer>
        <div class="last">
            <div class="list" data-aos="fadeInUp" data-aous-duration="2000">
                <h1 class="heading">OPENING HOURS</h1>  
                
                <li>Monday - Friday ..... 8am-10pm</li>
                <li>Saturday - Sunday ..... 10am-8pm</li>
                <li>Sunday is off</li>
            </div>
            <div class="list" data-aos="fadeInUp" data-aous-duration="2000">
                <h1 class="heading">ACCOUNTS</h1>
               
                <li><a href="#">Admin</a></li>
                <li><a href="./client-login.php">Client</a></li>
                <li><a href="./register.php">Register</a></li>
            </div>
            <div class="list" data-aos="fadeInUp" data-aous-duration="2000">
                <h1 class="heading">INFORMATION</h1>
                
                <li><a href="#about">About us</a></li>
                <li><a href="#stock">New stock</a></li>
                <li><a href="#contact">Contact us</a></li>
                <li><a href="#">Terms and condition</a></li>
            </div>
            <div class="list" data-aos="fadeInUp" data-aous-duration="2000">
                <h1 class="heading">STORE INFORMATION</h1>
                
                <li><a href="#"><i class="fa fa-map-locator"></i>&nbsp;My Campany, 42 Avenue des Champs Elyess 750000 Paris France</a></li>
                <li><a href="#"><i class="fa fa-phone"></i>&nbsp;Hotline1: +256 785545211 <br>Hotline2: +256 754555145</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i>&nbsp;Email:Info@gmail.com</a></li>
            </div>
        </div>
        <hr>
        <div class="copyright">
            &copy; Copyright all rights reserved by Ssewankambo derick.
        </div>
     </footer>
     <script src="./jquery/jquery-3.6.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./swiper-bundle.min.js"></script>
    <script src="./aos.js"></script>
    <script>
     var swiper = new Swiper(".slide-content", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      fade: 'true',
      grabCursor: 'true',
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
    </script>
    
    <script>
        //variables
        let menubar = document.querySelector('.left_bar');
        let mynav = document.querySelector('.child-2');

        menubar.onclick = () =>{
            menubar.classList.toggle('fa-times');
            mynav.classList.toggle('active');
        }
    </script>
 
    <script>
        //variables
            let thumbails = document.getElementsByClassName("thumbnail");
            let slider = document.getElementById("slider");
            let buttonRight= document.getElementById("slide-right");
            let buttonLeft= document.getElementById("slide-left");


            buttonLeft.addEventListener("click", () => {
                slider.scrollLeft -= 125;

            });
            buttonRight.addEventListener("click", () => {
                slider.scrollLeft += 125;

            });
    </script>
    <script>
        if (!window.Cypress)  AOS.init();
    </script>
    <script>
        $('.viewItem').click(function(){
            med_id = $(this).attr('id')
            $.ajax({
                url: 'select.php',
                method: 'post',
                data: {id_med:med_id},
                success: function(result){
                    $(".modal-body").html(result);
                }
            });
            $('#userModal').modal('show');
        })
    </script>
    <script>
             $('.Viewblog').click(function(){
            med_id = $(this).attr('id')
            $.ajax({
                url: 'select2.php',
                method: 'post',
                data: {id_med:med_id},
                success: function(result){
                    $(".modal-body").html(result);
                }
            });
            $('#Testimonies').modal('show');
        })
    </script>
</body>
</html>