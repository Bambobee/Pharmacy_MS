<?php
include('../config/Database.php');
include('function.php');

if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Add") {
        $statement = $conn->prepare("
   INSERT INTO tbl_medicine_stock (name, generic, packing, batch, expiry, supplier, quantity, price, active, date) 
   VALUES (:name, :generic, :packing, :batch, :expiry, :supplier, :quantity, :price, :active, :date)
  ");
        $result = $statement->execute(
            array(
                ':name' => good_data($_POST['name']),
                ':generic' => good_data($_POST['generic']),
                ':packing' => good_data($_POST['packing']),
                ':batch' => good_data($_POST['batch']),
                ':expiry' => good_data($_POST['expiry']),
                ':supplier' => good_data($_POST['supplier']),
                ':quantity' => good_data($_POST['quantity']),
                ':price' => good_data($_POST['price']),
                ':active' => good_data($_POST['active']),
                ':date' => good_data($_POST['date'])
            )
        );
        if (!empty($result)) {
            echo 'Data Inserted';
        }
    }
    if ($_POST["operation"] == "Edit") {
        $image = '';
        // Checking for whether image is not null to unlink it without throwing error
        $sql = "SELECT * FROM tbl_medicine_stock WHERE id=:id";
        $query = $conn->prepare($sql);
        $query->bindValue(':id', $_POST['user_id']);
        $query->execute();
        $statement = $conn->prepare(
            "UPDATE tbl_medicine_stock
   SET name = :name, generic = :generic, packing = :packing, batch = :batch, expiry = :expiry, supplier = :supplier,
    quantity = :quantity, price = :price, date = :date, active = :active
   WHERE id = :id
   "
        );
        $result = $statement->execute(
            array(
                ':name' => good_data($_POST['name']),
                ':generic' => good_data($_POST['generic']),
                ':packing' => good_data($_POST['packing']),
                ':batch' => good_data($_POST['batch']),
                ':expiry' => good_data($_POST['expiry']),
                ':supplier' => good_data($_POST['supplier']),
                ':quantity' => good_data($_POST['quantity']),
                ':price' => good_data($_POST['price']),
                ':active' => good_data($_POST['active']),
                ':date' => good_data($_POST['date']),
                ':id'   => $_POST["user_id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }
}
