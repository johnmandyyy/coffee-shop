<?php
require_once '../connection.php';


function executeReport($query)
{
    try {
        // Include your database connection
        global $pdo;
        $stmt = $pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;

    } catch (PDOException $e) {
        return [];
    }

}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // REPORT QUERIES
    $_DAILY_SALE = "SELECT SUM(total_price) 
FROM transaction_header WHERE is_done = 1 AND DATE(dot) = CURDATE();";

    $_WEEKLY_SALE = "SELECT SUM(total_price) 
FROM transaction_header WHERE is_done = 1 AND DATE(dot) 
BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE();";

    $_MONTHLY_SALE = "SELECT SUM(total_price) 
FROM transaction_header WHERE is_done = 1 AND DATE(dot) 
BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE();";

    $_YEARLY_SALE = "SELECT SUM(total_price) 
FROM transaction_header WHERE is_done = 1 AND DATE(dot) 
BETWEEN CURDATE() - INTERVAL 365 DAY AND CURDATE();";

    $_PENDING_CUSTOMERS_ORDER = "SELECT COUNT(*) FROM transaction_header where is_done = 0;";

    // RE-ASSIGNMENT OF VARIABLES
    $_DAILY_SALE = executeReport($_DAILY_SALE);
    $_WEEKLY_SALE = executeReport($_WEEKLY_SALE);
    $_MONTHLY_SALE = executeReport($_MONTHLY_SALE);
    $_YEARLY_SALE = executeReport($_YEARLY_SALE);
    $_PENDING_CUSTOMERS_ORDER = executeReport($_PENDING_CUSTOMERS_ORDER);



    http_response_code(200);
    echo json_encode([
        "daily_sales" => implode($_DAILY_SALE[0]),
        "weekly_sales" => implode($_WEEKLY_SALE[0]),
        "monthly_sales" => implode($_MONTHLY_SALE[0]),
        "yearly_sales" => implode($_YEARLY_SALE[0]),
        "pending_customers_order" => implode($_PENDING_CUSTOMERS_ORDER[0])
    ]);

} else {
    http_response_code(400);
    echo json_encode([
        "message" => "Only GET method is allowed."
    ]);
}





?>