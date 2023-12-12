<?php include('./partials/menu.php'); ?>
<div class="contain">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container bg-light">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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

                </ul>
                <form class="d-flex" method="GET">
                    <input class="form-control me-2" id="searchCategory" placeholder="Search">
                </form>
            </div>
        </div>
    </nav>
    <div class="category-page page">
        <h2 class="start">CATEGORIES</h2>
        <p style="text-align: center; font-size: 15px;">Try to search for the category you want.</p>
        <div class="combine">
            <?php
   $stmt = $conn->prepare("select * from tbl_category WHERE active='Yes';");
   $stmt->execute();
   $result = $stmt->get_result();
   while($row = $result->fetch_assoc()):
      $image = '';
      if ($row["image"] != '') {
          $image = '<img style="width: 100%; height: 100%; border-radius: var(--card-border-radius);"
           src="../Admin/Category_images/' . $row["image"] . '" />';
      } else {
          $image = '<div style="color: #ff4757;">Image not Added.</div>';
      }
   ?>
            <a href="<?php echo SITEURL; ?>category-medicine.php?category=<?= $row['id']; ?>">
                <div class="float">
                    <?= $image; ?>
                    <h4 class="inside"><?= $row['name'] ?></h4>
                </div>
            </a>
            <?php endwhile; ?>
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

<script>
$(document).ready(function() {
    $("#searchCategory").on("keyup", function() {
        var search = $(this).val().toLowerCase();
        $.ajax({
            url: "search_Category.php",
            method: "GET",
            data: {
                search: search
            },
            success: function(data) {
                $(".combine").html(data);
            }
        });
    });
});
</script>
</body>

</html>