<!DOCTYPE html>
<html>

<?php
session_start();

error_reporting(0);

include 'header.php';
include 'body.php';
include '../partials/footer.php';

if (!isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) {
    header(header: 'Location: /coffee-shop/pages/login.php');
}

?>

</html>