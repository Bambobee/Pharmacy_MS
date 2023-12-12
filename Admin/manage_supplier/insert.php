<?php
include('../config/Database.php');
include('function.php');

if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Add") {
        $statement = $conn->prepare("
   INSERT INTO tbl_supplier (name, email, phone, address) 
   VALUES (:name, :email, :phone, :address)
  ");
        $result = $statement->execute(
            array(
                ':name' => good_data($_POST['name']),
                ':email' => good_data($_POST['email']),
                ':phone' => good_data($_POST['phone']),
                ':address' => good_data($_POST['address']),
            )
        );
        if (!empty($result)) {
            echo 'Data Inserted';
        }
    }
    if ($_POST["operation"] == "Edit") {
        $image = '';
        // Checking for whether image is not null to unlink it without throwing error
        $sql = "SELECT * FROM tbl_supplier WHERE id=:id";
        $query = $conn->prepare($sql);
        $query->bindValue(':id', $_POST['user_id']);
        $query->execute();
        $statement = $conn->prepare(
            "UPDATE tbl_supplier
   SET name = :name, email = :email, phone = :phone, address = :address  
   WHERE id = :id
   "
        );
        $result = $statement->execute(
            array(
                ':name' => good_data($_POST['name']),
                ':email' => good_data($_POST['email']),
                ':phone' => good_data($_POST['phone']),
                ':address' => good_data($_POST['address']),
                ':id'   => $_POST["user_id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }
}
