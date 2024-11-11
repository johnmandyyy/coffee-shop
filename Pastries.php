<?php
// config.php

// Base URL for images (adjust the path according to your directory structure)
$baseUrl = "/images/";

// Image paths
$logoImg = $baseUrl . "assets/images/Logo1.png";
$profileImg = $baseUrl . "assets/images/prof.png";
$cartImg = $baseUrl . "assets/images/cart.png";

// Social media icons
$facebookIcon = $baseUrl . "fb-icon.png";
$instagramIcon = $baseUrl . "ig-icon.png";
$twitterIcon = $baseUrl . "tw-icon.png";

// Contact Info
$email = "contact@craffe.com";
$phone = "(123) 456-7890";

// Social Media Links (optional)
$facebookLink = "#";
$instagramLink = "#";
$twitterLink = "#";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastries Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        header {
            background-color: transparent;
            color: brown;
            padding: 10px;
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

        .Pastries-title {
            font-size: 36px;
            font-weight: bold;
            color: #f5f5f5;
            text-align: center;
            margin: 20px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(90deg, #8b5a2b, #d2b48c);
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .back-button {
            position: absolute;
            top: 130px;
            left: 40px;
            padding: 10px 20px;
            background-color: #fff;
            border: 2px solid #333;
            border-radius: 8px;
            font-size: 16px;
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
            padding: 20px;
            width: 100%;
            justify-content: center;
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
            flex: 0 0 calc(25% - 30px);
            height: 250px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menu-item img {
            width: 120px;
            height: 120px;
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

        .menu-item img[alt="Croissant"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Danish Pastry"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Chocolate Cake"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Apply Pie"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Cheesecake"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Muffin"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Brownie"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Tart"] {
            width: 180px;
            height: 180px;
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
            margin-top: 100px;
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

        @media (max-width: 768px) {
            .menu-item {
                flex: 0 0 calc(50% - 30px);
            }
        }

        @media (max-width: 480px) {
            .menu-item {
                flex: 0 0 100%;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            <img src="assets/images/Logo1.png" alt="Logo">
            <span class="logo-text">Craffé</span>
        </div>
        <div class="icons">
            <a href="#profile"><img src="assets/images/prof.png" alt="Profile" class="profile-icon"></a>
            <a href="#cart"><img src="assets/images/cart.png" alt="Cart" class="cart-icon"></a>
        </div>
    </header>

    <button class="back-button" onclick="goBack()">Back</button>

    <!-- Title for Pastries -->
    <div class="Pastries-title">Pastries Menu</div>

    <div class="menu-container" id="menu-container">
        <?php
        // Loop through the menu items and display them
        
        $menuItems = [
            ["image" => "assets/images/pas.png", "name" => "Croissant"],
            ["image" => "assets/images/pas.png", "name" => "Danish Pastry"],
            ["image" => "assets/images/pas.png", "name" => "Chocolate Cake"],
            ["image" => "assets/images/pas.png", "name" => "Apple Pie"],
            ["image" => "assets/images/pas.png", "name" => "Cheesecake"],
            ["image" => "assets/images/pas.png", "name" => "Muffin"],
            ["image" => "assets/images/pas.png", "name" => "Brownie"],
            ["image" => "assets/images/pas.png", "name" => "Tart"],
        ];

        foreach ($menuItems as $item) {
            echo '<div class="menu-item">';
            echo '<img src="' . $item["image"] . '" alt="' . $item["name"] . '">';
            echo '<h3>' . $item["name"] . '</h3>';
            echo '</div>';
        }
        ?>
    </div>

    <footer>
        <div class="footer-logo">
            <img src="assets/images/Logo1.png" alt="Footer Logo">
            <span class="logo-text">Craffé</span>
        </div>
        <div class="footer-section">
            <h4>Contact Us</h4>
            <p>Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
            <p>Phone: <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></p>
        </div>
        <div class="footer-section">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="<?php echo $facebookLink; ?>"><img src="<?php echo $facebookIcon; ?>" alt="Facebook"></a>
                <a href="<?php echo $instagramLink; ?>"><img src="<?php echo $instagramIcon; ?>" alt="Instagram"></a>
                <a href="<?php echo $twitterLink; ?>"><img src="<?php echo $twitterIcon; ?>" alt="Twitter"></a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?php echo date("Y"); ?> Craffé. All rights reserved.
        </div>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>

</html>