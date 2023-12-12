<?php
function get_total_and_customers()
{
    include('../config/Database.php');
    $query = "SELECT 
                SUM(CAST(amount_paid AS DECIMAL(10,2))) AS total_money,
                COUNT(DISTINCT email) AS total_customers
              FROM 
                tbl_orders 
              WHERE 
                status = 'Delivered' AND MONTH(date) = MONTH(CURRENT_DATE())";
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $total_money = $result['total_money'] ?? 0; // Set default value if total_money is NULL
    $total_customers = $result['total_customers'] ?? 0; // Set default value if total_customers is NULL
    return array('total_money' => $total_money, 'total_customers' => $total_customers);
}
?>
