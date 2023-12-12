<?php

function get_image_name($user_id)
{
    include('../config/Database.php');
    $statement = $conn->prepare("SELECT image FROM tbl_users WHERE id = '$user_id'");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row["image"];
    }
}

function get_total_all_records()
{
    include('../config/Database.php');
    $statement = $conn->prepare("SELECT * FROM tbl_users");
    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();
}