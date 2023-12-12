<?php
include('../config/Database.php');
include('function.php');
if (isset($_POST["user_id"])) {
    $output = array();
    $statement = $conn->prepare(
        "SELECT * FROM tbl_purchase
  WHERE id = '" . $_POST["user_id"] . "' 
  LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output["name"] = $row["name"];
        $output["voucher"] = $row["voucher"];
        $output["medicine"] = $row["medicine"];
        $output["price"] = $row["price"];
        $output["qty"] = $row["qty"];
        $output["paking"] = $row["paking"];
        $output["date"] = $row["date"];
        $output["payment"] = $row["payment"];
        $output["amount"] = $row["amount"];
    }
    echo json_encode($output);
}
