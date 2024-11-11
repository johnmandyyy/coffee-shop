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

        .coffee-title {
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

        .category-filter {
            margin-bottom: 20px;
        }

        .category-filter label {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .category-filter select {
            font-size: 18px;
            padding: 10px 15px;
            width: 120px;
            border: 2px solid #333;
            border-radius: 5px;
            background-color: #f5f5f5;
            cursor: pointer;
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
            width: 250px;
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

    <div class="coffee-title">Coffee Based</div>

    <div class="category-filter">
        <label for="category">Select Category: </label>
        <select id="category" onchange="filterMenu()">
            <option value="all">All</option>
            <option value="hot">Hot</option>
            <option value="cold">Cold</option>
            <option value="bottle">Bottle</option>
        </select>
    </div>

    <div class="menu-container" id="menu-container">
        <?php
        $menuItems = [
            ["src" => "assets/images/Cof.png", "alt" => "Hot Latte", "name" => "Hot Latte", "category" => "hot"],
            ["src" => "assets/images/Cof.png", "alt" => "Hot Choco", "name" => "Hot Choco", "category" => "hot"],
            ["src" => "assets/images/Cof.png", "alt" => "Hot Brew", "name" => "Hot Brew", "category" => "hot"],
            ["src" => "assets/images/Cof.png", "alt" => "Americano", "name" => "Americano", "category" => "hot"],
            ["src" => "assets/images/Cof.png", "alt" => "Coffee Frappe", "name" => "Coffee Frappe", "category" => "cold"],
            ["src" => "assets/images/Cof.png", "alt" => "Milktea", "name" => "Milktea", "category" => "cold"],
            ["src" => "assets/images/Cof.png", "alt" => "Bottled Brew", "name" => "Bottled Brew", "category" => "bottle"],
            ["src" => "assets/images/Cof.png", "alt" => "Bottled Latte", "name" => "Bottled Latte", "category" => "bottle"],
        ];

        foreach ($menuItems as $item) {
            echo '<div class="menu-item" data-category="' . $item['category'] . '">';
            echo '<img src="' . $item['src'] . '" alt="' . $item['alt'] . '">';
            echo '<h3>' . $item['name'] . '</h3>';
            echo '</div>';
        }
        ?>
    </div>

    <footer>
        <div class="footer-logo">
            <img src="<?= $footerLogoSrc; ?>" alt="Craffé MYCC">
            <div class="social-icons">
                <img src="<?= $facebookSrc; ?>" alt="facebook">
                <img src="<?= $instaSrc; ?>" alt="instagram">
                <img src="<?= $emailSrc; ?>" alt="email">
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
        function filterMenu() {
            var selectedCategory = document.getElementById("category").value;
            var menuItems = document.getElementsByClassName("menu-item");

            for (var i = 0; i < menuItems.length; i++) {
                var itemCategory = menuItems[i].getAttribute("data-category");

                if (selectedCategory === "all" || selectedCategory === itemCategory) {
                    menuItems[i].style.display = "flex";
                } else {
                    menuItems[i].style.display = "none";
                }
            }
        }

        function goBack() {
            window.history.back();
        }

        function selectProduct(name, description, imageSrc) {
            // Correct the URL format to include "?" for query parameters
            window.location.href = `Custom.php?name=${encodeURIComponent(name)}&description=${encodeURIComponent(description)}&imageSrc=${encodeURIComponent(imageSrc)}`;
        }

        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function () {
                const name = this.querySelector('h3').innerText;
                const imageSrc = this.querySelector('img').src;
                selectProduct(name, "This is a description for " + name, imageSrc);
            });
        });
    </script>

</body>

</html>