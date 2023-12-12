<?php
// include the database configuration file
include("config/config.php");

// check if search term is provided
if(isset($_GET['search'])) {
  
  // get the search term
  $search_term = $_GET['search'];
  
  // prepare the SQL statement to search for medicine products
  $stmt = $conn->prepare("SELECT * FROM tbl_medicine WHERE active='yes' AND (name LIKE ? OR description LIKE ?)");
  
  // bind the search term to the statement
  $search_term = "%{$search_term}%";
  $stmt->bind_param("ss", $search_term, $search_term);
  
  // execute the SQL statement
  $stmt->execute();
  
  // get the result set
  $result = $stmt->get_result();
  
  // check if any results were found
  if($result->num_rows === 0) {
    // display a message if no results were found
    echo '<div class="alert alert-warning" role="alert">No results found for "'.$search_term.'".</div>';
  } else {
    // display the search results

    while($row = $result->fetch_assoc()) {
      // display the medicine product information
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
                            <input type="hidden" class="pname" value="<?= $row['name']; ?>">
                            <input type="hidden" class="pimage" value="<?= $row['image']; ?>">
                            <input type="hidden" class="pprice" value="<?= $row['price']; ?>">
                            <input type="hidden" class="pcode" value="<?= $row['batch']; ?>">
                            <button style="padding-top: 10px;" class="together btn-sm addItemBtn"><i class="bx bx-cart-alt"></i>&nbsp;Add to cart</button>
                            </form>
                            <button style="padding-top: -8px;" class="together viewItem btn-sm" id="<?= $row['id']; ?>"><i class="bx bx-show"></i>&nbsp;View</button>
                        </div>
                    </div>
                </div>
                <script>
$(".addItemBtn").click(function(e){
    e.preventDefault();
    var $form = $(this).closest(".form-submit");
    var pid = $form.find(".pid").val();    
    var pname = $form.find(".pname").val();    
    var pimage = $form.find(".pimage").val();    
    var pprice = $form.find(".pprice").val();       
    var pcode = $form.find(".pcode").val();       
    
    $.ajax({
        url: 'action.php',
        method: 'post',
        data: {pid:pid,pname:pname,pimage:pimage,pprice:pprice,pcode:pcode},
        success:function(response){
            $("#message").html(response);
            window.scrollTo(0,0);
            load_cart_item_number();
        }
    });
 });
 load_cart_item_number();

    function load_cart_item_number(){
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {cartItem:"cart_item"},
        success:function(response){
          $("#cart-item").html(response);
        }
      })
    }
    
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
<?php
    }

  }
} else {
  // display an error message if no search term was provided
  echo '<div class="alert alert-danger" role="alert">Search term not provided.</div>';
}
?> 