<?php include('./partials/menu.php'); ?>

<div class="container">
<div class="row justify-content-center ">
<div class="col-lg-6 px-4 pb-4 " id="order">
<h2 class="text-center p-2" style="font-size: 30px;">Send Us a Message</h2>
<p class="text-center ">Incase of any Problem, Suggestion and Consultation we are available 24/7 Thank You.</p>

<form action="email.php" method="post"><br>
<?php
      $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>
       
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $fetch['name']; ?>"><br>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $fetch['email']; ?>"><br>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" name="contact" class="form-control" value="<?php echo $fetch['contact']; ?>"><br>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject \ Topic</label>
                    <input type="text" name="subject" class="form-control" placeholder="Enter the subject" autocomplete="off"><br>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" class="form-control" rows="3" placeholder="Enter the message.."></textarea><br>
                </div>
                <div class="mb-3">
                <button class="btn btn-danger form-control btn-block" type="submit" name="send">Send Message</button>
                <span></span>
                </div>
            </form>
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
<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/java.js"></script>
<script src="./assets/index.js"></script>
<script src="./script.js"></script>
</body>
</html>