<?php

require_once 'connection.php';

session_start();

// Make sure the request is a PATCH method
if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    global $pdo;
    // Check if the 'table' GET parameter is provided
    if (isset($_GET['table']) && !empty($_GET['table'])) {

        // Get the 'table' from the query string
        $tableName = $_GET['table'];

        // Get the 'id' from the URL (this assumes the URL is like /patch.php/1234/)
        $request_uri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($request_uri, '/')); // Split by "/"
        $id = $segments[3];

        if (empty($id)) {
            // If no ID is provided in the URL
            http_response_code(400); // Bad Request
            echo json_encode(["message" => "ID is required."]);
            exit;
        }

        // Read the raw POST data (assuming it's in JSON format)
        $jsonData = file_get_contents('php://input');

        // Decode the JSON data into a PHP associative array
        $data = json_decode($jsonData, true);

        // Check if the JSON data is valid (not null)
        if ($data !== null) {

            // Initialize the query string with the table name and WHERE clause
            $query = "UPDATE " . $tableName . " SET ";
            $setClause = [];
            $params = [":id" => $id]; // Array to hold parameters for prepared statements (including ID)



            // Loop through the decoded data to build the SET clause
            foreach ($data as $key => $value) {
                $setClause[] = "$key = :$key";
                $params[":$key"] = $value;  // Bind each value to a parameter
            }

            // If there are fields to update, join them with commas and append the WHERE clause
            if (!empty($setClause)) {
                $query .= implode(', ', $setClause); // Add the fields to the SET part
                $query .= " WHERE id = :id";  // Ensure we update the correct row by ID
            } else {
                // If no data to update, return an error
                http_response_code(400); // Bad Request
                echo json_encode(["message" => "No data to update."]);
                exit;
            }

            try {
                // Assuming you have a PDO connection ($pdo)
                $stmt = $pdo->prepare($query); // Prepare the SQL query
                $stmt->execute($params); // Execute the query with parameters

                if ($stmt->rowCount() > 0) {
                    // Successfully updated the record
                    http_response_code(200); // OK
                    echo json_encode(["message" => "Record updated successfully."]);
                } else {
                    // If no rows were affected, the record may not exist
                    http_response_code(404); // Not Found
                    echo json_encode(["message" => "Record not found or no changes made."]);
                }

            } catch (PDOException $e) {
                // If there is an error with the database, catch the exception
                http_response_code(500); // Internal Server Error
                echo json_encode(["message" => "There was a problem with the request.", "error" => $e->getMessage()]);
            }

        } else {
            // If no valid JSON data was provided, return an error
            http_response_code(400); // Bad Request
            echo json_encode(["message" => "Invalid or empty JSON data."]);
        }

    } else {
        // If no 'table' GET parameter is provided or it is empty
        http_response_code(400); // Bad Request
        echo json_encode(["message" => "No table was defined in the query string."]);
    }

} else {
    // If the request method is not PATCH, return an error
    http_response_code(405); // Method Not Allowed
    echo json_encode(["message" => "Only PATCH method is allowed."]);
}

?>