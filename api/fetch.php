<?php
require_once 'connection.php';



// If table does not exist.


function getAvailableColumns($table_name)
{
    try {
        // Include your database connection
        global $pdo;

        $table_name = preg_replace('/[^a-zA-Z0-9_]/', '', $table_name);
        $sql = "DESCRIBE " . $table_name;

        $stmt = $pdo->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;

    } catch (PDOException $e) {
        return [];
    }

}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['table']) && !empty($_GET['table'])) {
        $tableName = $_GET['table'];


        if (preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {

            try {
                // Prepare the dynamic SQL query
                $sql = "SELECT * FROM `$tableName`";
                $stmt = $pdo->query($sql); // Execute the query
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                header('Content-Type: application/json');

                if ($results) {
                    // Return the results as a JSON response
                    echo json_encode($results, JSON_PRETTY_PRINT);
                } else {
                    // Return empty table does exist but no record.
                    echo json_encode([]);
                }
            } catch (PDOException $e) {
                // Handle any errors during query execution
                http_response_code(404);

                echo json_encode([
                    "message" => "There was a problem with the request."
                ]);
            }

        } else { // Else for no table defined from sanitized data.

            http_response_code(404);
            echo json_encode([
                "message" => "No record does exist."
            ]);
        }

    } else { // Else for tno table was defined.
        echo json_encode([]);
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') { // A POST method for SELECT where
    header('Content-Type: application/json');

    if (isset($_GET['table']) && !empty($_GET['table'])) {

        // Get the table name from the URL
        $tableName = $_GET['table'];

        // Read the raw POST data (assuming it's in JSON format)
        $jsonData = file_get_contents('php://input');

        // Decode the JSON data into a PHP associative array
        $data = json_decode($jsonData, true);

        // Check if the JSON data is valid (not null)
        if ($data !== null) {

            // Initialize the query string with the table name and WHERE clause
            $query = "SELECT * FROM " . $tableName . " WHERE ";
            $conditions = [];
            $params = []; // Array to hold parameters for prepared statements

            // Loop through the decoded data to build the conditions
            foreach ($data as $key => $value) {
                $conditions[] = "$key = '$value'";
                $params[":$key"] = $value;  // Bind each value to a parameter
            }

            // If there are conditions, join them with 'AND' and append to the query
            if (!empty($conditions)) {
                $query .= implode(separator: ' AND ', array: $conditions);
            } else {
                // If no conditions were provided in the JSON data, return an error message
                http_response_code(400); // Bad Request
                echo json_encode([
                    "message" => "No filtering conditions provided."
                ]);

                exit; // Stop execution
            }

            try {
                // Prepare the dynamic SQL query

                $stmt = $pdo->query($query); // Execute the query
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                header('Content-Type: application/json');

                if ($results) {
                    echo json_encode($results, JSON_PRETTY_PRINT);
                } else {

                    http_response_code(response_code: 404);
                    echo json_encode([
                        "message" => "No results were found."
                    ]);

                }

            } catch (PDOException $e) {
                http_response_code(response_code: 404);
                echo json_encode([
                    "message" => "There was a problem with the request."
                ]);
            }

        } else {


            // If no valid JSON data was provided, return a 404 response
            http_response_code(400); // Bad Request

            $availableColumns = getAvailableColumns($tableName);

            $fields = array_map(function ($item) {
                return $item['Field'];
            }, array: $availableColumns);

            echo json_encode([
                "message" => "No data was provided.",
                "fields_available" => $fields,
                "metadata" => $availableColumns
            ]);

        }

    } else {
        // If no 'table' GET parameter is provided or it is empty, return an error
        http_response_code(response_code: 404);
        echo json_encode([
            "message" => "No table was defined."
        ]);
    }



}


?>