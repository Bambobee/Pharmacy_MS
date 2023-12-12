<?php
include('../config/Database.php');
include('function.php');

if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Add") {
        $statement = $conn->prepare("
   INSERT INTO tbl_purchase (name, voucher, medicine, price, qty, amount, paking, payment) 
   VALUES (:name, :voucher, :medicine, :price, :qty, :amount, :paking, :payment)
  ");
        $result = $statement->execute(
            array(
                ':name' => good_data($_POST['name']),
                ':voucher' => good_data($_POST['voucher']),
                ':medicine' => good_data($_POST['medicine']),
                ':price' => good_data($_POST['price']),
                ':qty' => good_data($_POST['qty']),
                ':amount' => good_data($_POST['price']) * good_data($_POST['qty']),
                ':paking' => good_data($_POST['paking']),
                ':payment' => good_data($_POST['payment']),
            )
        );
        if (!empty($result)) {
            echo 'Data Inserted';
        }
    }
    if ($_POST["operation"] == "Edit") {
        $image = '';
        // Checking for whether image is not null to unlink it without throwing error
        $sql = "SELECT * FROM tbl_purchase WHERE id=:id";
        $query = $conn->prepare($sql);
        $query->bindValue(':id', $_POST['user_id']);
        $query->execute();
        $statement = $conn->prepare(
            "UPDATE tbl_purchase
   SET name = :name, medicine = :medicine, price = :price, qty = :qty, voucher = :voucher, amount = :amount, paking = :paking, payment = :payment  
   WHERE id = :id
   "
        );
        $result = $statement->execute(
            array(
                ':name' => good_data($_POST['name']),
                ':medicine' => good_data($_POST['medicine']),
                ':price' => good_data($_POST['price']),
                ':qty' => good_data($_POST['qty']),
                ':voucher' => good_data($_POST['voucher']),
                ':amount' => good_data($_POST['price']) * good_data($_POST['qty']),
                ':paking' => good_data($_POST['paking']),
                ':payment' => good_data($_POST['payment']),
                ':id'   => $_POST["user_id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }
}
