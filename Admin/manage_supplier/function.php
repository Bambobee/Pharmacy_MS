<?php
function get_total_all_records()
{
    include('../config/Database.php');
    $statement = $conn->prepare("SELECT * FROM tbl_supplier");
    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();
}
function good_data($data){
    $result = trim($data);
    $result = htmlentities($data);
    $result = htmlspecialchars($data);
    $result = stripcslashes($data);
    return $result;
}