<?php
// Database credentials
$host = 'localhost'; // or your database host
$dbname = 'CraffeDB';
$username = 'root';
$password = '';

try {
    // Create a PDO instance and establish a connection
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO(dsn: $dsn, username: $username, password: $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>