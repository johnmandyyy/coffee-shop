<?php

require_once '../connection.php'; // Assuming you have a DB connection


function setReceiptSQL($fileName, $id)
{
    global $pdo;
    $query = "UPDATE `transaction_header` SET receipt_image = '" . $fileName . "' WHERE id = " . $id;
    //return $query;

    $stmt = $pdo->prepare(query: $query); // Prepare the SQL query
    $stmt->execute(); // Execute the query with parameters

    // Check if the insert was successful
    if ($stmt->rowCount() > 0) {

        return true;

    }

    return false;

}

function uploadFile()
{
    // Define the target directory where you want to save the uploaded files
    $targetDirectory = "../../media/"; // Make sure this directory exists and has write permissions

    // Get the original file extension
    $fileType = strtolower(string: pathinfo($_FILES["paymentReceipt"]["name"], PATHINFO_EXTENSION));

    // Generate a unique file name based on the current date-time
    $randomFileName = "receipt_" . date("Ymd_His") . "_" . uniqid() . "." . $fileType;

    // Define the target file path with the new unique file name
    $targetFile = $targetDirectory . $randomFileName;

    $uploadOk = 1;

    // Allowed file types (you can adjust this list)
    $allowedFileTypes = ["jpg", "png", "jpeg", "gif", "pdf", "docx", "txt"];

    // Check if the file is a valid image or document
    if (!in_array($fileType, $allowedFileTypes)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOCX, and TXT files are allowed.";
        $uploadOk = 0;
    }

    // Check if the file size is acceptable (for example, max 5MB)
    if ($_FILES["paymentReceipt"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload the file

        $info = setReceiptSQL($randomFileName, $_POST['id']);

        if (move_uploaded_file($_FILES["paymentReceipt"]["tmp_name"], $targetFile)) {
            http_response_code(response_code: 200);
            echo json_encode(value: [
                "message" => 'File was uploaded successfully.',
                "is_uploaded" => $info
            ]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["paymentReceipt"])) {
    uploadFile();
}

?>