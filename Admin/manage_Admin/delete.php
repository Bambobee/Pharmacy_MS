<?php

include('../config/Database.php');
include("function.php");

if (isset($_POST["user_id"])) {
    $image = get_image_name($_POST["user_id"]);
    $sql = "select * from tbl_admin where id=:id";
    $query = $conn->prepare($sql);
    $query->bindValue(':id', $_POST['user_id']);
    $query->execute();
    $image = $query->fetch();
    if ($image['image'] != '') {
        unlink("../Admin_images/" . $image['image']);
    }
    $statement = $conn->prepare(
        "DELETE FROM tbl_admin WHERE id = :id"
    );
    $result = $statement->execute(
        array(
            ':id' => $_POST["user_id"]
        )
    );

    if (!empty($result)) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data deleted successfully.</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}
