<?php
include('../config/Database.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM tbl_category ";
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE id LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR name LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR featured LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR active LIKE "%' . $_POST["search"]["value"] . '%" ';
}
if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id DESC ';
}
if ($_POST["length"] != -1) {
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
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
        $image = '<img src="./Category_images/' . $row["image"] . '" class="img-thumbnail" width="60" height="40" />';
    } else {
        $image = '<div style="color: #ff4757;">Image not Added.</div>';
    }
    $sub_array = array();
    $sub_array[] = $count;
    $sub_array[] = $image;
    $sub_array[] = $row["name"];
    $sub_array[] = $row["active"];
    $sub_array[] = $row["featured"];
    $sub_array[] = $row["date"];
    $sub_array[] = '
		<div class="dropdown">
			<a class="btn btn-light hidden-arrow dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="bx bx-dots-vertical text-danger"></i>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="#" name="update" id="' . $row["id"] . '" class=" dropdown-item update btn-sm btn btn-warning"><i class="bx bx-edit"></i> Edit</a>
				</li>
                <li>
					<button type="submit" name="delete" id="' . $row["id"] . '" class="dropdown-item btn-sm btn btn-danger delete">
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
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  $filtered_rows,
    "recordsFiltered" => get_total_all_records(),
    "data"    => $data
);
echo json_encode($output);
