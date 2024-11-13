<?php
session_start();

try {

    require_once 'connection.php';

    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);

    // Prepare the SQL statement
    $stmt = $pdo->prepare("SELECT * FROM register WHERE username = :username");
    $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
    $stmt->execute();

    // Check if the user exists
    if ($stmt->rowCount() > 0) {
        // Fetch the hashed password from the database
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verify the password
        if (password_verify($data['password'], $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            http_response_code(200);
            echo json_encode([
                "message" => "Login successful."
            ]);

            exit;
        } else {
            // Set error message for incorrect login
            http_response_code(404);
            echo json_encode([
                "message" => "Invalid username or password."
            ]);
        }
    } else {
        // User does not exist
        http_response_code(404);
        echo json_encode([
            "message" => "User does not exist."
        ]);
    }
} catch (PDOException $e) {
    // Handle potential PDO errors
    http_response_code(500);
    echo json_encode([
        "message" => "System error."
    ]);

}

?>