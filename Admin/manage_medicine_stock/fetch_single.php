<?php
include('../config/Database.php');
include('function.php');
if (isset($_POST["user_id"])) {
    $output = array();
    $statement = $conn->prepare(
        "SELECT * FROM tbl_medicine_stock
  WHERE id = '" . $_POST["user_id"] . "' 
  LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output["name"] = $row["name"];
        $output["generic"] = $row["generic"];
        $output["packing"] = $row["packing"];
        $output["batch"] = $row["batch"];
        $output["expiry"] = $row["expiry"];
        $output["supplier"] = $row["supplier"];
        $output["quantity"] = $row["quantity"];
        $output["price"] = $row["price"];
        $output["active"] = $row["active"];
        $output["date"] = $row["date"];
    }
    echo json_encode($output);
}
