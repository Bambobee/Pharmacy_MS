<?php include("config.php"); ?>
<?php

if(isset($_POST["id_med"])){
    $output = '';
    $stmt = $conn->prepare("SELECT * FROM tbl_medicine WHERE id = '".$_POST["id_med"]."'");
    $stmt->execute();
    $result = $stmt->get_result();
}


while($row = $result->fetch_assoc()) {
    $image = '';
    if ($row["image"] != '') {
        $image = '<img style="width: 100%; height: 100%; " src="./Admin/medicine_images/'.$row["image"].'" />';
    } else {
        $image = '<div style="color: #ff4757;">Image not added.</div>';
    }
   $output .= '
<div class="food">
    <div class="food-img">
       '.$image.'
    </div>
    <div class="food-desc">
        <h4>'.$row['name'].'</h4><br>
        <div class="price-item">
            <p class="food-price">Price : UgShs '.number_format($row['price'], 2).'/-</p> <br>
            <p class="food-detail">Description : '.$row['description'].'</p>
        </div><br><br>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
</div>';
}
echo $output;