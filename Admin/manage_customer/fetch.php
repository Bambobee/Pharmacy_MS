<?php
include('../config/Database.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM tbl_users ";
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE id LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR name LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR email LIKE "%' . $_POST["search"]["value"] . '%" ';
}
if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id DESC ';
}
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

$count = 1;
foreach ($result as $row) {
    $image = '';
    if ($row["image"] != '') {
        $image = '<img src="../Client/uploaded_img/' . $row["image"] . '" class="img-thumbnail" width="60" height="40" />';
    } else {
        $image = '<div style="color: #ff4757;">Image not Added.</div>';
    }
    $sub_array = array();
    $sub_array[] = $count;
    $sub_array[] = $image;
    $sub_array[] = $row["name"];
    $sub_array[] = $row["email"];
    $sub_array[] = $row["contact"];
    $sub_array[] = $row["address"];
    $sub_array[] = $row["email_verified_at"];
    $data[] = $sub_array;
    $count++;
}
$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  $filtered_rows,
    "recordsFiltered" => get_total_all_records(),
    "data"    => $data
);
echo json_encode($output);
