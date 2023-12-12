<?php
function get_total_all_records()
{
    include('../config/Database.php');
    $statement = $conn->prepare("SELECT * FROM tbl_message");
    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();
}
