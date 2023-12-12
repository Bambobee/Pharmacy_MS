<?php
include('../config/Database.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM tbl_message ";
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE id LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR name LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR email LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR status LIKE "%' . $_POST["search"]["value"] . '%" ';
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
    $sub_array = array();
    $sub_array[] = $count;
    $sub_array[] = $row["name"];
    $sub_array[] = $row["email"];
    $sub_array[] = $row["contact"];
    $sub_array[] = $row["subject"];
    $sub_array[] = substr($row['message'], 0, 30);
    $sub_array[] = $row["status"];
    $sub_array[] = $row["date"];
    $sub_array[] = '
		<div class="dropdown">
			<a class="btn btn-light hidden-arrow dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="bx bx-dots-vertical text-danger"></i>
			</a>
			<ul class="dropdown-menu">
				<li>
                <a href="#" name="update" id="' . $row["id"] . '" class=" dropdown-item update btn-sm btn btn-warning"><i class="bx bx-edit"></i> Update</a>
				</li>
				<li>
					<button type="submit" name="delete" id="' . $row["id"] . '" class="dropdown-item btn-sm btn btn-danger delete">
						<i class="bx bx-trash"></i>
						Delete
					</button>
				</li>
                <li>
					<button class="dropdown-item btn-sm btn" data-bs-toggle="modal" data-bs-target="#userModal' . $row["id"] . '">
						<i class="bx bx-show"></i>
						View
					</button>
				</li>
			</ul>
		</div>

        <div class="modal fade" id="userModal' . $row["id"]. '">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" style="background: var(--color-white); height: auto; padding: 2%; font-size: 17px;">
                <h2 class="modal-title">View Message</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> '.$row['name'].' </p>
                            <p><strong>Email:</strong> '.$row['email'].'</p>
                            <p><strong>Contact:</strong> '.$row['contact'].'</p>
                        </div>
                        <div class="col-md-6" >
                            <p><strong>Message:</strong></p>
                            <p style="overflow-x: scroll; width: 250px;">'.$row['message'].'</p>
                        </div>
                    </div><br> 
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    ';
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
