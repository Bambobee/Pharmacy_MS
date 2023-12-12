<?php
include('../config/Database.php');
include('function.php');

if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Add") {
        $image = '';
        if ($_FILES["user_image"]["name"] != '') {
            $image = upload_image();
        }
        $statement = $conn->prepare("
   INSERT INTO tbl_admin (name, email, image, password, userType) 
   VALUES (:name, :email, :image, :password, :userType)
  ");
        $result = $statement->execute(
            array(
                ':name' => good_data($_POST['name']),
                ':email' => good_data($_POST['email']),
                ':password' => md5($_POST['password']),
                ':userType' => $_POST['userType'],
                ':image'  => $image
            )
        );
        if (!empty($result)) {
            echo 'Data Inserted';
        }
    }
    if ($_POST["operation"] == "Edit") {
        $image = '';
        // Checking for whether image is not null to unlink it without throwing error
        $sql = "SELECT * FROM tbl_admin WHERE id=:id";
        $query = $conn->prepare($sql);
        $query->bindValue(':id', $_POST['user_id']);
        $query->execute();
        $user_image = $query->fetch();

        if ($_FILES["user_image"]["name"] != '') {
            $image = upload_image();
            if ($user_image['image'] != null) {
                unlink("../Admin_images/" . $_POST["hidden_user_image"]); // On update, remove old image
            }
        } else {
            $image = $_POST["hidden_user_image"];
        }
        $statement = $conn->prepare(
            "UPDATE tbl_admin
   SET name = :name, email = :email, password = :password, image = :image, userType = :userType  
   WHERE id = :id
   "
        );
        $result = $statement->execute(
            array(
                ':name' => good_data($_POST['name']),
                ':email' => good_data($_POST['email']),
                ':password' => md5($_POST['password']),
                ':userType' =>$_POST['userType'],
                ':image'  => $image,
                ':id'   => $_POST["user_id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }
}
