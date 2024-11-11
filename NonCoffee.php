<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Menu</title>
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
            padding: 10px 0;
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
            margin-bottom: 20px;
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
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-icon {
            width: 50px;
            height: 50px;
        }

        .cart-icon {
            width: 35px;
            height: 35px;
        }

        .non-coffee-title {
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
            /* Adjusted width for 4 items per row */
            height: 220px;
            /* Set a fixed height for consistency */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menu-item img {
            width: 100px;
            /* Smaller image size */
            height: 100px;
            /* Smaller image size */
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

        .menu-item img[alt="Hot Latte"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Hot Choco"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Hot Brew"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Brewed Coffee"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Café Americano"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Cold Latte"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Mocha"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Espresso"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Cappuccino"] {
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
                /* 2 items per row on medium screens */
            }
        }

        @media (max-width: 480px) {
            .menu-item {
                flex: 0 0 100%;
                /* 1 item per row on small screens */
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
            <a href="#profile">
                <img src="assets/images/prof.png" alt="Profile" class="profile-icon">
            </a>
            <a href="#cart">
                <img src="assets/images/cart.png" alt="Cart" class="cart-icon">
            </a>
        </div>
    </header>

    <button class="back-button" onclick="goBack()">Back</button>

    <div class="non-coffee-title">Non-Coffee Based</div>

    <div class="menu-container">
        <?php
        // Array of menu items
        $menuItems = [
            ['src' => 'assets/images/Cof.png', 'title' => 'Hot Latte', 'category' => 'hot'],
            ['src' => 'assets/images/Cof.png', 'title' => 'Hot Choco', 'category' => 'hot'],
            ['src' => 'assets/images/Cof.png', 'title' => 'Brewed Coffee', 'category' => 'hot'],
            ['src' => 'assets/images/Cof.png', 'title' => 'Café Americano', 'category' => 'hot'],
            ['src' => 'assets/images/Cof.png', 'title' => 'Cold Latte', 'category' => 'cold'],
            ['src' => 'assets/images/Cof.png', 'title' => 'Mocha', 'category' => 'cold'],
            ['src' => 'assets/images/Cof.png', 'title' => 'Espresso', 'category' => 'cold'],
            ['src' => 'assets/images/Cof.png', 'title' => 'Cappuccino', 'category' => 'cold'],
            // Add more items as needed
        ];

        // Generate menu item HTML
        foreach ($menuItems as $item) {
            echo '<div class="menu-item">';
            echo '<img src="' . $item['src'] . '" alt="' . $item['title'] . '">';
            echo '<h3>' . $item['title'] . '</h3>';
            echo '</div>';
        }
        ?>
    </div>

    <footer>
        <div class="footer-logo">
            <img src="assets/images/Logoo.png" alt="Craffé MYCC">
            <div class="social-icons">
                <img src="assets/images/facebook.png" alt="Facebook">
                <img src="assets/images/insta.png" alt="Instagram">
                <img src="assets/images/email.png" alt="Email">
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

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>

</html>