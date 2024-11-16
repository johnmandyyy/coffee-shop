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

$_query = "SELECT *, COUNT(*) as 'times_sold', (COUNT(*) * total_price_of_all) as 'generated_stream' FROM previous_order where previous_order.is_done = 1 GROUP BY json_order ORDER by times_sold desc LIMIT 2;";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $results = executeReport($_query);
    http_response_code(200);
    echo json_encode($results, JSON_PRETTY_PRINT);
}

?>