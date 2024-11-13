<?php

error_reporting(E_ERROR | E_PARSE);
session_start();
require_once 'connection.php';


$_INITIAL_TRANSACTION_TABLE = 'transaction_header';
$_TRANSACTION_HISTORY_TABLE = 'transaction_history';
$_PREVIOUS_ORDER_TABLE = 'previous_order';
$_REGISTRATION_TABLE = 'register';


function registerUser()
{
    // Make sure the request is a POST method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $pdo;
        global $_REGISTRATION_TABLE;


        // Check if the 'table' GET parameter is provided
        if (isset($_GET['table']) && !empty($_GET['table'])) {

            // Get the 'table' from the query string
            $tableName = $_GET['table'];

            // Ensure the table name matches the expected one
            if ($tableName != $_REGISTRATION_TABLE) {
                return false;
            }

            // Read the raw POST data (assuming it's in JSON format)
            $jsonData = file_get_contents('php://input');

            // Decode the JSON data into a PHP associative array
            $data = json_decode($jsonData, true);

            // Check if the JSON data is valid (not null)
            if ($data !== null) {

                // Initialize the query string with the table name
                $query = "INSERT INTO " . $tableName . " (" . implode(", ", array_keys($data)) . ") ";
                $query .= "VALUES (:" . implode(", :", array_keys($data)) . ")";

                // Prepare the parameters to bind to the query
                $params = [];
                foreach ($data as $key => $value) {


                    $params[":$key"] = $value;


                    if ($key === 'password') {
                        $params[":$key"] = password_hash($value, PASSWORD_DEFAULT);
                    }

                }

                try {
                    // Assuming you have a PDO connection ($pdo)
                    $stmt = $pdo->prepare($query); // Prepare the SQL query
                    $stmt->execute($params); // Execute the query with parameters

                    // Check if the insert was successful
                    if ($stmt->rowCount() > 0) {
                        // Successfully inserted the record
                        http_response_code(201); // Created
                        echo json_encode(["message" => "Record inserted successfully."]);
                        return true;

                    } else {
                        // If no rows were affected, something went wrong
                        http_response_code(400); // Bad Request
                        echo json_encode(["message" => "Failed to insert record."]);
                        return true;
                    }

                } catch (PDOException $e) {
                    return false;
                }

            } else {
                // If no valid JSON data was provided, return an error
                http_response_code(400); // Bad Request
                echo json_encode(["message" => "Invalid or empty JSON data."]);
                return true;
            }

        } else {
            // If no 'table' GET parameter is provided or it is empty
            http_response_code(400); // Bad Request
            echo json_encode(["message" => "No table was defined in the query string."]);
            return true;
        }

    } else {
        // If the request method is not POST, return an error
        http_response_code(405); // Method Not Allowed
        echo json_encode(["message" => "Only POST method is allowed."]);
        return true;
    }
}


function universalInsert()
{
    // Make sure the request is a POST method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $pdo;

        // Check if the 'table' GET parameter is provided
        if (isset($_GET['table']) && !empty($_GET['table'])) {

            // Get the 'table' from the query string
            $tableName = $_GET['table'];

            // Read the raw POST data (assuming it's in JSON format)
            $jsonData = file_get_contents('php://input');

            // Decode the JSON data into a PHP associative array
            $data = json_decode($jsonData, true);

            // Check if the JSON data is valid (not null)
            if ($data !== null) {

                // Initialize the query string with the table name
                $query = "INSERT INTO " . $tableName . " (" . implode(", ", array_keys($data)) . ") ";
                $query .= "VALUES (:" . implode(", :", array_keys($data)) . ")";

                // Prepare the parameters to bind to the query
                $params = [];
                foreach ($data as $key => $value) {
                    $params[":$key"] = $value;
                }

                try {
                    // Assuming you have a PDO connection ($pdo)
                    $stmt = $pdo->prepare($query); // Prepare the SQL query
                    $stmt->execute($params); // Execute the query with parameters

                    // Check if the insert was successful
                    if ($stmt->rowCount() > 0) {
                        // Successfully inserted the record
                        http_response_code(201); // Created
                        echo json_encode(["message" => "Record inserted successfully."]);
                        return true;

                    } else {
                        // If no rows were affected, something went wrong
                        http_response_code(400); // Bad Request
                        echo json_encode(["message" => "Failed to insert record."]);
                        return true;
                    }

                } catch (PDOException $e) {
                    return false;
                }

            } else {
                // If no valid JSON data was provided, return an error
                http_response_code(400); // Bad Request
                echo json_encode(["message" => "Invalid or empty JSON data."]);
                return true;
            }

        } else {
            // If no 'table' GET parameter is provided or it is empty
            http_response_code(400); // Bad Request
            echo json_encode(["message" => "No table was defined in the query string."]);
            return true;
        }

    } else {
        // If the request method is not POST, return an error
        http_response_code(405); // Method Not Allowed
        echo json_encode(["message" => "Only POST method is allowed."]);
        return true;
    }
}


function previousOrder()
{

    global $pdo;
    global $_PREVIOUS_ORDER_TABLE;

    try {
        // Get the table name from the URL, ensure it's set and not empty
        if (!isset($_GET['table']) || empty($_GET['table'])) {
            return false;
        }

        $tableName = $_GET['table'];

        // Ensure the table name matches the expected one
        if ($tableName != $_PREVIOUS_ORDER_TABLE) {
            return false;
        }

        // Read the raw POST data (assuming it's in JSON format)
        $jsonData = file_get_contents('php://input');

        // Check if JSON data is empty or not provided
        if (empty($jsonData)) {
            return false;
        }

        // Decode the JSON data into a PHP associative array
        $data = json_decode($jsonData, true);
        $previous_orders = json_encode($data['previous_order'], true);

        // Check if the JSON is valid (should not be null)
        if ($data === null) {
            return false;
        }

        // Check if data is an array and not empty
        if (!is_array($data) || empty($data)) {
            return false;
        }

        $query = 'INSERT INTO `previous_order` (`json_order`, `transaction_header_id`, `dot`) VALUES (:json_order, :transaction_header_id, NOW());';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':json_order', $previous_orders, PDO::PARAM_STR);
        $stmt->bindParam(':transaction_header_id', $data['transaction_header_id'], type: PDO::PARAM_INT);
        $stmt->execute();

        return true;

    } catch (Exception $e) {
        // Handle exceptions by returning a 400 Bad Request response with the error message
        http_response_code(400);
        echo json_encode([
            "message" => "Bad request: " . $e->getMessage()
        ]);
    }
}

function callInitialTransaction($user_id)
{
    global $pdo;

    $stmt = $pdo->prepare("CALL InsertTransactionHeader(" . $user_id . ")");
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['inserted_id'];
    }

    return -1;
}

function callUpdateTransactionHistory($transaction_header_id)
{
    global $pdo;

    $stmt = $pdo->prepare("CALL UpdateTransactionHistory(" . $transaction_header_id . ")");
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['inserted_id'];
    }

    return -1;
}

function setTotalPrice($transaction_header_id)
{
    global $pdo;

    $query = "CALL SetTotalPriceByID" . "(" . $transaction_header_id . ")";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

}
function initializeTransaction()
{
    global $_INITIAL_TRANSACTION_TABLE;

    try {
        // Get the table name from the URL
        $tableName = $_GET['table'];
        // Read the raw POST data (assuming it's in JSON format)
        $jsonData = file_get_contents('php://input');
        // Decode the JSON data into a PHP associative array
        $data = json_decode(json: $jsonData, associative: true);

        if ($tableName == $_INITIAL_TRANSACTION_TABLE) {
            $transaction_header_id = callInitialTransaction($_SESSION['user_id']);
            if ($data['initial_transact'] === true && $transaction_header_id !== -1) {

                http_response_code(response_code: 201);
                echo json_encode([
                    "transaction_header_id" => $transaction_header_id,
                    "message" => "Initial transaction was created."
                ]);

            } else {
                http_response_code(response_code: 400);
                echo json_encode([
                    "message" => "No transaction header id was created."
                ]);
            }
            return true;
        }
        return false;

    } catch (Exception $e) {
        http_response_code(response_code: 400);
        echo json_encode([
            "message" => "Bad request"
        ]);
    }
}

function transactionHistory()
{
    global $pdo;
    global $_TRANSACTION_HISTORY_TABLE;

    try {
        // Get the table name from the URL, ensure it's set and not empty
        if (!isset($_GET['table']) || empty($_GET['table'])) {
            return false;
        }

        $tableName = $_GET['table'];

        // Ensure the table name matches the expected one
        if ($tableName != $_TRANSACTION_HISTORY_TABLE) {
            return false;
        }

        // Read the raw POST data (assuming it's in JSON format)
        $jsonData = file_get_contents('php://input');

        // Check if JSON data is empty or not provided
        if (empty($jsonData)) {
            return false;
        }

        // Decode the JSON data into a PHP associative array
        $data = json_decode($jsonData, true);

        // Check if the JSON is valid (should not be null)
        if ($data === null) {
            return false;
        }

        // Check if data is an array and not empty
        if (!is_array($data) || empty($data)) {
            return false;
        }

        // Loop through the decoded data (array of transaction records)

        $tran_id = null;
        foreach ($data as $item) {
            // Ensure that each record contains the necessary keys
            if (!isset($item['transaction_header_id']) || !isset($item['debitable_id'])) {
                return false;
            }

            $tran_id = $item['transaction_header_id'];

            // Prepare the SQL statement for insertion
            $sql = "INSERT INTO $tableName (transaction_header_id, debitable_id) VALUES (:transaction_header_id, :debitable_id)";
            $stmt = $pdo->prepare($sql);

            // Bind parameters and execute the insert for each item
            $stmt->bindParam(':transaction_header_id', $item['transaction_header_id'], PDO::PARAM_INT);
            $stmt->bindParam(':debitable_id', $item['debitable_id'], PDO::PARAM_INT);
            $stmt->execute();

            setTotalPrice(transaction_header_id: $tran_id);
            callUpdateTransactionHistory(transaction_header_id: $tran_id);
            //echo $tran_id;
        }
        // Optionally return a success message or value
        return true;

    } catch (Exception $e) {
        // Handle exceptions by returning a 400 Bad Request response with the error message
        http_response_code(400);
        echo json_encode([
            "message" => "Bad request: " . $e->getMessage()
        ]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // A POST method for SELECT where
    header('Content-Type: application/json');

    if (isset($_GET['table']) && !empty($_GET['table'])) {



        // Two special cases insert.
        if (registerUser() === true) {
            return 0; // Use guard clause return so no other blocks are executed.
        } // Check it is for initial transaction

        // Two special cases insert.
        if (initializeTransaction() === true) {
            return 0; // Use guard clause return so no other blocks are executed.
        } // Check it is for initial transaction

        if (transactionHistory() === true) {

            http_response_code(response_code: 201);
            echo json_encode([
                "message" => "Transaction is completed."
            ]);

            return 0; // Use guard clause return so no other blocks are executed.
        } // Check if it is for transaction history.


        if (previousOrder() === true) {

            http_response_code(response_code: 201);
            echo json_encode([
                "message" => "Saved as previous order."
            ]);

            return 0; // Use guard clause return so no other blocks are executed.
        } // Check if it is for transaction history.

        // Reserved for universal insertion.
        if (universalInsert() === true) {
            return 0; // Use guard clause return so no other blocks are executed.
        } // Check if it is for transaction history.

        http_response_code(response_code: 400);
        echo json_encode([
            "message" => "There was a problem in the request."
        ]);

    } else {
        // If no 'table' GET parameter is provided or it is empty, return an error
        http_response_code(response_code: 404);
        echo json_encode([
            "message" => "No table was defined."
        ]);

    }

}

?>