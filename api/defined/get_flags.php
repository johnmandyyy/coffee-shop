<?php

require_once '../connection.php';


function executeQuery($query)
{
    global $pdo;

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;

}

$_GET_LAST_ORDER_ID = 'SELECT register.last_order_id FROM register WHERE id = ';
$_GET_COUNT_OF_ORDERS = 'SELECT COUNT(*) FROM previous_order WHERE previous_order.register_id = ';
$_MODULO_QUERY = 'SELECT COUNT(*) FROM previous_order WHERE previous_order.register_id = ';
$_GET_LOYALTY_FLAG = 'SELECT loyalty_flag FROM register WHERE id = ';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = $_GET['id'];

        $_MODULO_QUERY = $_MODULO_QUERY . $id;
        $_GET_MODULO = 'SELECT MOD((' . $_MODULO_QUERY . '), 10)';

        http_response_code(200);
        echo json_encode([
            "loyalty_flag" => implode(executeQuery($_GET_LOYALTY_FLAG . ($id))),
            "last_order_id" => implode(executeQuery($_GET_LAST_ORDER_ID . ($id))),
            "order_count" => implode(executeQuery($_GET_COUNT_OF_ORDERS . ($id))),
            "modulo" => implode(executeQuery($_GET_MODULO))
        ]);


    }

}

?>