<?php
include('../config/Database.php');
include('function.php');

$query = '';
$output = array();
$query .= "SELECT * FROM tbl_orders ";

if (isset($_POST["search"]["value"])) {
    $searchValue = $_POST["search"]["value"];
    $query .= "WHERE id LIKE '%$searchValue%' ";
    $query .= "OR name LIKE '%$searchValue%' ";
    $query .= "OR email LIKE '%$searchValue%' ";
    $query .= "OR status LIKE '%$searchValue%' ";
}

if (isset($_POST["order"])) {
    $orderColumn = $_POST['order']['0']['column'];
    $orderDir = $_POST['order']['0']['dir'];
    $query .= "ORDER BY $orderColumn $orderDir ";
} else {
    $query .= 'ORDER BY id DESC ';
}

$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filteredRows = $statement->rowCount();

$count = 1;
foreach ($result as $row) {
    $subArray = array();
    $subArray[] = $count;
    $subArray[] = $row["name"];
    $subArray[] = $row["email"];
    $subArray[] = $row["contact"];
    $subArray[] = $row["amount_paid"];
    $subArray[] = $row["address"];
    $subArray[] = $row["pmode"];
    $subArray[] = $row["status"];
    $subArray[] = $row["date"];
    $subArray[] = $row["time"];
    $subArray[] = '
        <div class="dropdown">
            <a class="btn btn-light hidden-arrow dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-dots-vertical text-danger"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#" name="update" id="' . $row["id"] . '" class="dropdown-item update btn-sm btn btn-warning"><i class="bx bx-edit"></i> Update</a>
                </li>
                <li>
                <button class="dropdown-item btn-sm btn" data-bs-toggle="modal" data-bs-target="#userModal' . $row["id"] . '">
                <i class="bx bx-show"></i>
                View
            </button>
                </li>
            </ul>
        </div>

        <!-- Modal -->
<div class="modal fade" id="userModal' . $row["id"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body" style="background: var(--color-white); height: auto; padding: 2%; font-size: 17px;">
                <h4 class="text-center p-2" style="font-size: 30px;">View Order!</h4>
                <div class="jumbotron p-3 mb-2 text-center" style="background: var(--color-white);">
                    <h6 class="lead" style="overflow: auto;">
                        <b>Customer Name : </b> ' . $row["name"] . '
                    </h6>
                    <h6 class="lead">
                        <b>Product(s) : </b> ' . $row["products"] . '
                    </h6>
                </div><br> 
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
     
    ';
    $data[] = $subArray;
    $count++;
}

$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $filteredRows,
    "recordsFiltered" => $filteredRows,
    "data" => $data
);

echo json_encode($output);
