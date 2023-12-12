<?php

include('../config/Database.php');
include("function.php");

if (isset($_POST["user_id"])) {
   
    $statement = $conn->prepare(
        "DELETE FROM tbl_supplier WHERE id = :id"
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
