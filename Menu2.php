<?php
// Define variables for images and links
$logoImage = "assets/images/Logo1.png";
$footerLogoImage = "assets/images/Logoo.png";
$profileIcon = "assets/images/prof.png";
$cartIcon = "assets/images/cart.png";

$coffeePageLink = "CoffePage.php";
$nonCoffeePageLink = "NonCoffee.php";
$milkTeaPageLink = "MilkTea.php";
$frappePageLink = "Frappe.php";
$sodaPageLink = "Soda.php";

$socialFacebook = "assets/images/facebook.png";
$socialInstagram = "assets/images/insta.png";
$socialEmail = "assets/images/email.png";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap">
    <style>
        body {
            margin: 0;
            padding-top: 0px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: ghostwhite;
            overflow-x: hidden;
            color: black;
            font-family: 'Alfa Slab One', sans-serif;
        }

        header {
            background-color: transparent;
            color: brown;
            padding: 1 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 3px solid brown;
            width: 100%;
            height: 100px;
            box-sizing: border-box;
            margin-bottom: 0px;
        }

        .logo {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 120px;
            height: auto;
        }

        .logo-text {
            font-size: 1.5em;
            margin-left: 5px;
        }

        .icons {
            position: absolute;
            top: 20px;
            right: 40px;
            transform: translate(-50%);
            display: flex;
            align-items: center;
            gap: -10px;
        }

        .profile-icon {
            width: 80px;
            height: 80px;
            display: block;
        }

        .cart-icon {
            width: 35px;
            height: 35px;
            display: block;
        }

        .icons a {
            border: none;
            outline: none;
        }

        .icons a:hover {
            background: none;
        }

        .back-button {
            position: absolute;
            top: 150px;
            left: 70px;
            padding: 10px 20px;
            background-color: #fff;
            border: 2px solid #333;
            border-radius: 8px;
            font-size: 26px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #333;
            color: #fff;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            /* Space between the boxes */
            padding: 20px;
            width: 100%;
            justify-content: center;
            margin-top: 7%;
        }

        .menu-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            background-color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            width: calc(25% - 30px);
            /* Four items per row, accounting for gaps */
            height: 300px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }


        .menu-item img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .menu-item h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
            text-align: center;
        }

        .menu-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }


        .coffee-base img {
            width: 200px;
            /* Increase the image size */
            height: 200px;
            /* Keep it proportional */
            border-radius: 10px;
            margin-top: 20px
        }

        .coffee-base h3 {
            font-size: 22px;
            /* Increase the text size */
            margin-top: 10px;
        }


        .noncoffee-base img {
            width: 200px;
            /* Increase the image size */
            height: 200px;
            /* Keep it proportional */
            border-radius: 10px;
            margin-top: 20px
        }

        .noncoffee-base h3 {
            font-size: 22px;
            /* Increase the text size */
            margin-top: 10px;
        }



        .milktea-base img {
            width: 200px;
            /* Increase the image size */
            height: 200px;
            /* Keep it proportional */
            border-radius: 10px;
            margin-top: 20px
        }

        .milktea-base h3 {
            font-size: 22px;
            /* Increase the text size */
            margin-top: 10px;
        }

        .Soda-base img {
            width: 200px;
            /* Increase the image size */
            height: 200px;
            /* Keep it proportional */
            border-radius: 10px;
            margin-top: 20px
        }

        .Soda-base h3 {
            font-size: 22px;
            /* Increase the text size */
            margin-top: 10px;
        }

        .Frappe-base img {
            width: 200px;
            /* Increase the image size */
            height: 200px;
            /* Keep it proportional */
            border-radius: 10px;
            margin-top: 20px
        }

        .Frappe-base h3 {
            font-size: 22px;
            /* Increase the text size */
            margin-top: 10px;
        }



        footer {
            position: relative;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.3);
            color: black;
            padding: 10px;
            text-align: center;
            width: 100%;
            border-top: 2px solid black;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 20px;
            box-sizing: border-box;
            margin-top: auto;
            backdrop-filter: blur(2px);
        }

        .footer-logo {
            flex: 1;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-left: 15%;
            gap: 20px;
        }

        .footer-logo img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .social-icons {
            display: flex;
            gap: 20px;
            margin-bottom: 10px;
        }

        .social-icons img {
            width: 40px;
            height: 35px;
            cursor: pointer;
        }

        .footer-section {
            flex: 1;
            text-align: left;
            margin-left: 0;
        }

        .footer-section h4 {
            margin: 0 0 10px;
            font-size: 1.2em;
            color: black;
        }

        .footer-section p,
        .footer-section a {
            margin: 0;
            color: black;
            text-decoration: none;
            font-size: 0.9em;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }

        .footer-bottom {
            width: 50%;
            border-top: 1px solid black;
            padding-top: 10px;
            text-align: center;
            margin-top: auto;
            margin-left: 25%;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            footer {
                flex-direction: column;
                align-items: center;
            }

            .footer-logo {
                margin-left: 0;
                justify-content: center;
            }

            .footer-section {
                text-align: center;
                margin-left: 0;
            }

            .footer-bottom {
                width: 100%;
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .menu-container {
                gap: 20px;
                justify-content: center;
            }

            .menu-item {
                width: calc(50% - 30px);
                /* Two items per row on smaller screens */
                height: 180px;
            }

            .back-box {
                padding: 8px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .menu-container {
                gap: 15px;
            }

            .menu-item {
                width: calc(100% - 30px);
                /* One item per row on mobile */
                height: 150px;
            }
        }
    </style>
    <script>
        function goBack() {
            window.history.back(); // Navigate to the previous page in the history
        }
    </script>
</head>

<header>
    <div class="logo">
        <img src="<?php echo $logoImage; ?>" alt="Logo">
        <span class="logo-text">Craffé</span>
    </div>
    <div class="icons">
        <a href="#profile">
            <img src="<?php echo $profileIcon; ?>" alt="Profile" class="profile-icon"></a>
        <a href="#cart">
            <img src="<?php echo $cartIcon; ?>" alt="Cart" class="cart-icon"></a>
    </div>
</header>

<button class="back-button" onclick="goBack()">Back</button>

<body>
    <div class="menu-container">
        <!-- Coffee Base Box -->
        <a href="<?php echo $coffeePageLink; ?>" class="menu-item coffee-base">
            <h3>Coffee Base</h3>
            <img src="assets/images/Cof.png" alt="Coffee Base">
        </a>

        <!-- Non-Coffee Base Box -->
        <a href="<?php echo $nonCoffeePageLink; ?>" class="menu-item noncoffee-base">
            <h3>Non-Coffee Base</h3>
            <img src="assets/images/Cof.png" alt="nonCoffee Base">
        </a>

        <!-- Milk Tea Base Box -->
        <a href="<?php echo $milkTeaPageLink; ?>" class="menu-item milktea-base">
            <h3>MilkTea Base</h3>
            <img src="assets/images/Cof.png" alt="milktea Base">
        </a>

        <!-- Frappe Base Box -->
        <a href="<?php echo $frappePageLink; ?>" class="menu-item Frappe-base">
            <h3>Frappe Base</h3>
            <img src="assets/images/Cof.png" alt="Frappe Base">
        </a>

        <!-- Soda Base Box -->
        <a href="<?php echo $sodaPageLink; ?>" class="menu-item Soda-base">
            <h3>Soda Base</h3>
            <img src="assets/images/Cof.png" alt="Soda Base">
        </a>
    </div>
</body>

<footer>
    <div class="footer-logo">
        <img src="<?= $footerLogoSrc; ?>" alt="Craffé MYCC">
        <div class="social-icons">
            <img src="<?= $facebookSrc; ?>" alt="Facebook">
            <img src="<?= $instaSrc; ?>" alt="Instagram">
            <img src="<?= $emailSrc; ?>" alt="Email">
        </div>
    </div>

    <div class="footer-section">
        <h4>About</h4>
        <p>Learn more about our story and mission to bring you the finest coffee experience.</p>
    </div>

    <div class="footer-section">
        <h4>Headquarters</h4>
        <p>Graceville 1 Subdivision,<br>Muzon, SJDM, Bulacan 3023</p>
    </div>

    <div class="footer-section">
        <h4>Quick Links</h4>
        <a href="#">Menu</a><br>
        <a href="#">About</a><br>
        <a href="#">Careers</a><br>
        <a href="#">Contact</a>
    </div>

    <div class="footer-bottom">
        <p>© 2024 Coffee Shop. All rights reserved.</p>
    </div>
</footer>

</html>