<?php
include('../config/Database.php');
include('function.php');
if (isset($_POST["user_id"])) {
    $output = array();
    $statement = $conn->prepare(
        "SELECT * FROM tbl_message
  WHERE id = '" . $_POST["user_id"] . "' 
  LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output["name"] = $row["name"];
        $output["email"] = $row["email"];
        $output["contact"] = $row["contact"];
        $output["date"] = $row["date"];
        $output["status"] = $row["status"];
    }
    echo json_encode($output);
}
