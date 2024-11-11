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
            border-bottom: 3px solid black;
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

        /* Title for Soda Based */
        .Soda-title {
            font-size: 36px;
            /* Increased font size */
            font-weight: bold;
            color: #f5f5f5;
            /* Light text color */
            text-align: center;
            /* Center the text */
            margin: 20px 0;
            /* Margin for spacing */
            text-transform: uppercase;
            /* Uppercase text */
            letter-spacing: 2px;
            /* Spacing between letters */
            background: linear-gradient(90deg, #8b5a2b, #d2b48c);
            /* Brown gradient background */
            padding: 10px;
            /* Padding for a nice look */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Shadow effect */
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

        /* Hover effect */
        .menu-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Back button styling */
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

        .menu-item img[alt="Cola"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Lemon-Lime Soda"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Root Beer"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Orange Soda"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Grape Soda"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Cream Soda"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Ginger Ale"] {
            width: 180px;
            height: 180px;
        }

        .menu-item img[alt="Sparkling Water"] {
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
            <a href="#profile">
                <img src="assets/images/prof.png" alt="Profile" class="profile-icon"></a>
            <a href="#cart">
                <img src="assets/images/cart.png" alt="Cart" class="cart-icon"></a>
        </div>
    </header>

    <button class="back-button" onclick="goBack()">Back</button>

    <!-- Title for Soda Based -->
    <div class="Soda-title">Soda Based</div>

    <div class="menu-container" id="menu-container">
        <?php
        $sodaItems = [
            ['image' => 'assets/images/Cof.png', 'name' => 'Cola'],
            ['image' => 'assets/images/Cof.png', 'name' => 'Lemon-Lime Soda'],
            ['image' => 'assets/images/Cof.png', 'name' => 'Root Beer'],
            ['image' => 'assets/images/Cof.png', 'name' => 'Orange Soda'],
            ['image' => 'assets/images/Cof.png', 'name' => 'Grape Soda'],
            ['image' => 'assets/images/Cof.png', 'name' => 'Cream Soda'],
            ['image' => 'assets/images/Cof.png', 'name' => 'Ginger Ale'],
            ['image' => 'assets/images/Cof.png', 'name' => 'Sparkling Water'],
        ];

        foreach ($sodaItems as $item): ?>
            <div class="menu-item soda">
                <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                <h3><?= $item['name'] ?></h3>
            </div>
        <?php endforeach; ?>
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