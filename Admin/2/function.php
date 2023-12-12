<?php
function get_total_and_customers()
{
    include('../config/Database.php');
    $query = "SELECT 
                SUM(CAST(order_total_after_tax AS DECIMAL(10,2))) AS total_money,
                COUNT(DISTINCT order_no) AS total_invoices
              FROM 
                tbl_order
            AND MONTH(order_date) = MONTH(CURRENT_DATE())";
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $total_money = $result['total_money'] ?? 0; // Set default value if total_money is NULL
    $total_customers = $result['total_invoices'] ?? 0; // Set default value if total_customers is NULL
    return array('total_money' => $total_money, 'total_invoices' => $total_invoices);
}
?>
