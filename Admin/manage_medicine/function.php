<?php

function upload_image()
{
    if (isset($_FILES["user_image"])) {
        if(!file_exists('../Medicine_images')){
            mkdir('Medicine_images');
        }
        $extension = explode('.', $_FILES['user_image']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = '../Medicine_images/' . $new_name;
        move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
        return $new_name;
    }
}

function get_image_name($user_id)
{
    include('../config/Database.php');
    $statement = $conn->prepare("SELECT image FROM tbl_medicine WHERE id = '$user_id'");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row["image"];
    }
}

function get_total_all_records()
{
    include('../config/Database.php');
    $statement = $conn->prepare("SELECT * FROM tbl_medicine");
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