<?php
include('../config/Database.php');

function get_total_all_records()
{
    include('../config/Database.php');
    $statement = $conn->prepare("SELECT * FROM tbl_medicine_stock WHERE `quantity` = 0");
    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();
}

function good_data($data)
{
    $result = trim($data);
    $result = htmlentities($result);
    $result = htmlspecialchars($result);
    $result = stripslashes($result);
    return $result;
}

$query = '';
$output = array();
$query .= "SELECT * FROM tbl_medicine_stock WHERE `quantity` = 0";

$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

$count = 1;
foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $count;
    $sub_array[] = $row["name"];
    $sub_array[] = $row["generic"];
    $sub_array[] = $row["packing"];
    $sub_array[] = $row["batch"];
    $sub_array[] = $row["expiry"];
    $sub_array[] = $row["supplier"];
    $sub_array[] = $row["quantity"];
    $sub_array[] = $row["price"];
    $sub_array[] = $row["active"];
    $sub_array[] = $row["date"];
    $sub_array[] = '
        <div class="dropdown">
            <a class="btn btn-light hidden-arrow dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-dots-vertical text-danger"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#" name="update" id="' . $row["id"] . '" class="dropdown-item update btn-sm btn btn-warning"><i class="bx bx-edit"></i> Edit</a>
                </li>
                <li>
                    <button type="button" name="delete" id="' . $row["id"] . '" class="dropdown-item btn-sm btn btn-danger delete">
                        <i class="bx bx-trash"></i>
                        Delete
                    </button>
                </li>
            </ul>
        </div>
    ';
    $data[] = $sub_array;
    $count++;
}
$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => get_total_all_records(),
    "data" => $data
);
echo json_encode($output);