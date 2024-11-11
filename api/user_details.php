<?php

session_start();



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) {

        http_response_code(200);
        echo json_encode([
            "message" => "User ID was retrieved.",
            "id" => $_SESSION['user_id']
        ]);
        exit;
    }

    http_response_code(400);
    echo json_encode(value: [
        "message" => "No logged in user.",
        "id" => null
    ]);


}

?>