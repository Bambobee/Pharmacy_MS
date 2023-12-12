<?php include("config.php"); ?>
<?php

if(isset($_POST["id_med"])){
    $output = '';
    $stmt = $conn->prepare("SELECT * FROM tbl_blog WHERE id = '".$_POST["id_med"]."'");
    $stmt->execute();
    $result = $stmt->get_result();
}


while($row = $result->fetch_assoc()) {
    $image = '';
    if ($row["image"] != '') {
        $image = '<img style="width: 100%; height: 100%; " src="./Client/uploaded_img/'.$row["image"].'" />';
    } else {
        $image = '<div style="color: #ff4757;"><img style="width: 100%; height: 100%; " src="./image/default-avatar.png" /></div>';
    }
   $output .= '
<div class="food">
    <div class="food-img">
       '.$image.'
    </div>
    <div class="food-desc">
        <h4>'.$row['name'].'</h4><br>
        <div class="price-item">
            <p class="food-detail">Message : '.$row['message'].'</p>
        </div><br><br>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
</div>';
}
echo $output;