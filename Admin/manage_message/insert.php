<?php
include('../config/Database.php');
include('function.php');


    if ($_POST["operation"] == "Update") {
        // Checking for whether image is not null to unlink it without throwing error
        $sql = "SELECT * FROM tbl_message WHERE id=:id";
        $query = $conn->prepare($sql);
        $query->bindValue(':id', $_POST['user_id']);
        $query->execute();
        $statement = $conn->prepare(
            "UPDATE tbl_message
   SET  status = :status  
   WHERE id = :id
   "
        );
        $result = $statement->execute(
            array(
                ':status' => $_POST['status'],
                ':id'   => $_POST["user_id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }

