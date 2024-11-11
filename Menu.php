<?php
// Variables for links and images
$homeLink = "Craffe.php";
$aboutLink = "About.php";
$menuLink = "#menu";
$feedbackLink = "#contact";
$beveragesLink = "Menu2.php";
$pastriesLink = "Pastries.php";
$logoSrc = "assets/images/Logo1.png";
$profileSrc = "assets/images/prof.png";
$cartSrc = "";
$facebookSrc = "assets/images/facebook.png";
$instaSrc = "assets/images/insta.png";
$emailSrc = "assets/images/email.png";
$footerLogoSrc = "assets/images/Logoo.png";

$slides = [
    ['src' => 'assets/images/pic5.png', 'alt' => 'Iced Coffee', 'class' => 'iced-coffee', 'title' => 'Iced Coffee', 'desc' => 'A refreshing blend of ice and coffee, perfect for a hot day.'],
    ['src' => 'assets/images/Matcha-removebg-preview.png', 'alt' => 'Munchkins Bucket', 'class' => 'munchkins', 'title' => 'Munchkins Bucket', 'desc' => 'Assorted flavors of munchkins in one bucket to share!'],
    ['src' => 'assets/images/Beans-removebg-preview.png', 'alt' => 'Espresso', 'class' => 'espresso', 'title' => 'Espresso', 'desc' => 'Strong and bold espresso for the coffee lovers.'],
    ['src' => 'https://i.imgur.com/r2dqfSJ.png', 'alt' => 'Latte', 'class' => 'latte', 'title' => 'Latte', 'desc' => 'A smooth blend of espresso and steamed milk.']
];
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
            position: relative;
            z-index: 0;
            margin: 0;
            padding-top: 0px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: ghostwhite;
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

        .sections-container {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            width: 100%;
            margin-top: 0px;
            padding-left: 20px;
        }

        .section {
            margin: 0 20px;
        }

        .section h4 {
            margin: 0;
            font-size: 1em;
            color: black;
            padding: 10px 20px;
            font-family: Lato;
        }

        .section a {
            display: inline-block;
            padding: 10px 20px;
            background-color: transparent;
            color: black;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2em;
            position: relative;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-align: center;
            font-family: 'Lato', sans-serif;
        }

        .section a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #AB886D;
            left: 0;
            top: 0;
            border-radius: 20px;
            z-index: -1;
            transition: transform 0.3s ease;
            transform: scale(0);
        }

        .section a:hover::after {
            transform: scale(1);
        }

        .section a:hover h4 {
            color: white;
            transform: translateY(-5px);
        }

        .carousel-container {
            width: 90%;
            max-width: 1650px;
            height: 600px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            margin-top: 180px;
            margin-left: 10%;
        }

        .menu-title {
            font-size: 2rem;
            color: #d35400;
            text-align: center;
            margin-top: 15px;
        }

        .carousel {
            height: calc(100% - 60px);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .slide {
            display: none;
            align-items: center;
            justify-content: space-between;
            text-align: left;
            width: 100%;
            padding: 0 40px;
        }

        .active {
            display: flex;
        }

        .slide img {
            border-radius: 15px;
        }

        .iced-coffee {
            width: 30%;
            margin-bottom: 200px;
            /* Adjust the bottom margin for Munchkins */
            margin-left: -20px;
        }

        .munchkins {
            width: 33%;
            margin-bottom: 225px;
            /* Adjust the bottom margin for Munchkins */
            margin-left: 44px;
        }

        .espresso {
            width: 28%;
            margin-bottom: 50px;
            /* Adjust the top margin for Espresso */
            margin-left: 70px;
        }

        .latte {
            width: 35%;
            margin-bottom: -10px;
            /* Adjust the bottom margin for Latte */
        }

        .slide-content {
            width: 50%;
        }

        .slide-content h2 {
            font-size: 2rem;
            color: #d35400;
            margin-bottom: 10px;
        }

        .slide-content p {
            font-size: 1.2rem;
            color: #555;
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            border: none;
            font-size: 2rem;
            color: #d35400;
            cursor: pointer;
            z-index: 10;
        }

        .arrow:hover {
            color: #e67e22;
        }

        .prev {
            left: 15px;
        }

        .next {
            right: 15px;
        }

        .dots {
            display: flex;
            justify-content: center;
            position: absolute;
            bottom: 15px;
            width: 100%;
        }

        .dot {
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
        }

        .dot.active {
            background-color: #d35400;
        }

        /* New Body Section for Menu */
        section {
            text-align: center;
            margin-top: 50px;
            padding-bottom: 50px;
            padding-top: 50px;
        }

        section h2 {
            font-size: 2.5em;
            margin-bottom: 30px;
            color: saddlebrown;
        }

        .menu-container {
            display: flex;
            justify-content: center;
            gap: 50px;
        }

        /* Styling for Beverages Box */
        .beverages-box {
            width: 650px;
            height: 600px;
            border: 3px solid brown;
            border-radius: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.7);
            transition: transform 0.3s ease;
            cursor: pointer;
            margin-bottom: 50px;
        }

        .beverages-box img {
            max-width: 100%;
            max-height: 450px;
            /* Adjust as needed */
            border-radius: 15px;
            margin-bottom: 600px;
        }

        .beverages-box h3 {
            margin: 10px 0;
            font-size: 1.7em;
            color: black;
        }

        .beverages-box:hover {
            transform: scale(1.05);
        }

        /* Styling for Pastries Box */
        .pastries-box {
            width: 650px;
            height: 600px;
            border: 3px solid brown;
            border-radius: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.7);
            transition: transform 0.3s ease;
            cursor: pointer;
            margin-bottom: 30px;
        }

        .pastries-box img {
            max-width: 100%;
            max-height: 600px;
            /* Adjust as needed */
            border-radius: 15px;
            margin-bottom: -100px;
        }

        .pastries-box h3 {
            margin: -150px 0;
            font-size: 1.7em;
            color: black;
        }

        .pastries-box:hover {
            transform: scale(1.05);
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

<header>
    <div class="logo">
        <img src="<?= $logoSrc; ?>" alt="Logo">
        <span class="logo-text">Craffé</span>
    </div>
    <div class="icons">
        <a href="#profile">
            <img src="<?= $profileSrc; ?>" alt="Profile" class="profile-icon"></a>
        <a href="#cart">
            <img src="<?= $cartSrc; ?>" alt="Cart" class="cart-icon"></a>
    </div>

    <div class="sections-container">
        <div class="section">
            <a href="<?= $homeLink; ?>">
                <h4>Home</h4>
            </a>
        </div>
        <div class="section">
            <a href="<?= $aboutLink; ?>">
                <h4>About</h4>
            </a>
        </div>
        <div class="section">
            <a href="<?= $menuLink; ?>">
                <h4>Menu</h4>
            </a>
        </div>
        <div class="section">
            <a href="<?= $feedbackLink; ?>">
                <h4>Feedback</h4>
            </a>
        </div>
    </div>
</header>

<body>

    <div class="carousel-container">
        <h1 class="menu-title">MENU</h1>
        <div class="carousel">
            <?php foreach ($slides as $index => $slide): ?>
                    <div class="slide <?= $index === 0 ? 'active' : ''; ?>">
                        <img src="<?= $slide['src']; ?>" alt="<?= $slide['alt']; ?>" class="<?= $slide['class']; ?>">
                        <div class="slide-content">
                            <h2><?= $slide['title']; ?></h2>
                            <p><?= $slide['desc']; ?></p>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>

        <button class="arrow prev" onclick="prevSlide()">❮</button>
        <button class="arrow next" onclick="nextSlide()">❯</button>

        <div class="dots">
            <?php foreach ($slides as $index => $slide): ?>
                    <span class="dot <?= $index === 0 ? 'active' : ''; ?>" onclick="showSlide(<?= $index; ?>)"></span>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Menu Section -->
    <section>
        <h2>Explore our Flavors</h2>
        <div class="menu-container">
            <!-- Beverages Section -->
            <a href="<?= $beveragesLink; ?>" class="beverages-box">
                <h3>Beverages</h3>
                <img src="assets/images/Bevs.jpg" alt="Beverages">
            </a>

            <!-- Pastries Section -->
            <a href="<?= $pastriesLink; ?>" class="pastries-box">
                <h3>Pastries</h3>
                <img src="assets/images/Pastries.png" alt="Pastries">
            </a>
        </div>
    </section>

    <!-- Footer -->
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

    <script>
        let currentIndex = 0;

        function showSlide(index) {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.dot');

            if (index < 0) {
                currentIndex = slides.length - 1;
            } else if (index >= slides.length) {
                currentIndex = 0;
            } else {
                currentIndex = index;
            }

            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === currentIndex);
            });

            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === currentIndex);
            });
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        // Initialize the first slide
        showSlide(currentIndex);
    </script>

</body>

</html>