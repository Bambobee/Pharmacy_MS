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
   INSERT INTO tbl_medicine (name, description, price, date, category, active, featured, image) 
   VALUES (:name, :description, :price, :date, :category, :active, :featured, :image)
  ");
        $result = $statement->execute(
            array(
                ':name' => good_data($_POST['name']),
                ':description' => good_data($_POST['description']),
                ':price' => good_data($_POST['price']),
                ':date' => good_data($_POST['date']),
                ':category' => $_POST['category'],
                ':active' => $_POST['active'],
                ':featured' => $_POST['featured'],
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
        $sql = "SELECT * FROM tbl_medicine WHERE id=:id";
        $query = $conn->prepare($sql);
        $query->bindValue(':id', $_POST['user_id']);
        $query->execute();
        $user_image = $query->fetch();

        if ($_FILES["user_image"]["name"] != '') {
            $image = upload_image();
            if ($user_image['image'] != null) {
                unlink("../Category_images/" . $_POST["hidden_user_image"]); // On update, remove old image
            }
        } else {
            $image = $_POST["hidden_user_image"];
        }
        $statement = $conn->prepare(
            "UPDATE tbl_medicine
   SET name = :name, description = :description, price = :price, date = :date, category = :category, active = :active, featured = :featured, image = :image  
   WHERE id = :id
   "
        );
        $result = $statement->execute(
            array(
                ':name' => good_data($_POST['name']),
                ':description' => good_data($_POST['description']),
                ':price' => good_data($_POST['price']),
                ':date' => good_data($_POST['date']),
                ':category' => $_POST['category'],
                ':active' => $_POST['active'],
                ':featured' => $_POST['featured'],
                ':image'  => $image,
                ':id'   => $_POST["user_id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }
}
