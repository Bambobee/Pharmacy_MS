<?php
include('../config/Database.php');
include('function.php');

$query = "SELECT 
            COUNT(DISTINCT email) AS total_customers,
            SUM(CAST(amount_paid AS DECIMAL(10,2))) AS total_money,
            MONTH(date) AS month
          FROM 
            tbl_orders 
          WHERE 
            status = 'Delivered' 
          GROUP BY 
            MONTH(date)";

$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
$data = array();
$filtered_rows = $statement->rowCount();

$count = 1;
foreach ($result as $row) {
  $sub_array = array();
  $sub_array[] = $count;
  $sub_array[] = $row["total_customers"];
  $sub_array[] = $row["total_money"];
  $sub_array[] = $row["month"];
  $data[] = $sub_array;
  $count++;
}

$output = array(
  "draw" => isset($_POST["draw"]) ? intval($_POST["draw"]) : 0,
  "recordsTotal" => $filtered_rows,
  "recordsFiltered" => $filtered_rows,
  "data" => $data
);

echo json_encode($output);
?>
