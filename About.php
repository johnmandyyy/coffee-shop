<?php
// Variables for links and images
$homeLink = "Craffe.php";
$aboutLink = "About.php";
$menuLink = "Menu.php";
$feedbackLink = "#contact";
$beveragesLink = "Menu2.php";
$pastriesLink = "Pastries.php";
$logoSrc = "assets/images/Logo1.png";
$profileSrc = "assets/images/prof.png";
$cartSrc = "assets/images/cart.png";
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
        {
            box-sizing: border-box;
            /* Ensures padding and border are included in total width/height */
        }

        body {
            margin: 0;
            padding: 0px;
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

        /* Trivia Section */
        .trivia-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px;
            background-color: ghostwhite;
            overflow-x: hidden;
            margin-top: 100px;
            width: 100%;
            position: relative;
        }

        .trivia-box {
            background-color: #AB886D;
            padding: 60px;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 1000px;
            max-width: 100%;
            color: white;
            position: relative;
            z-index: 1;
            margin-left: -100px;
        }

        .trivia-content h2 {
            font-size: 36px;
            margin: 0;
            padding: 0;
            font-weight: bold;
            color: white;
        }

        .trivia-content h3 {
            font-size: 48px;
            margin: 20px 0;
        }

        .trivia-content p {
            font-size: 28px;
            line-height: 1.8;
        }

        .arrows {
            display: flex;
            justify-content: space-between;
            position: absolute;
            width: calc(100% - 50px);
            top: 50%;
            transform: translateY(-50%);
            left: 100px;
            z-index: 0;
        }

        .arrow-left,
        .arrow-right {
            background-color: brown;
            color: orange;
            border: none;
            padding: 25px;
            font-size: 36px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: -350px;
            margin-right: -150px;
        }

        .arrow-left:hover,
        .arrow-right:hover {
            background-color: #007acc;
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

    <div class="trivia-container">
        <div class="trivia-box">
            <div class="trivia-content">
                <h2>Did You Know?</h2>
                <h3 id="trivia-title">Facts about Coffee</h3>
                <p id="trivia-text">Coffee is one of the most popular beverages in the world, with millions of cups
                    consumed daily.</p>
            </div>
            <div class="arrows">
                <button class="arrow-left" onclick="prevTrivia()">&#10094;</button>
                <button class="arrow-right" onclick="nextTrivia()">&#10095;</button>
            </div>
        </div>
    </div>

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
        let currentTrivia = 0;
        const triviaData = [
            { title: 'Facts about Coffee', text: 'Coffee is one of the most popular beverages in the world, with millions of cups consumed daily.' },
            { title: 'Coffee in History', text: 'Legend says coffee was discovered by a goat herder who noticed his goats becoming energetic after eating coffee berries.' },
            { title: 'Global Coffee Trade', text: 'Coffee is the second most traded commodity in the world, after crude oil.' }
        ];

        function updateTrivia() {
            document.getElementById('trivia-title').innerText = triviaData[currentTrivia].title;
            document.getElementById('trivia-text').innerText = triviaData[currentTrivia].text;
        }

        function prevTrivia() {
            currentTrivia = (currentTrivia === 0) ? triviaData.length - 1 : currentTrivia - 1;
            updateTrivia();
        }

        function nextTrivia() {
            currentTrivia = (currentTrivia === triviaData.length - 1) ? 0 : currentTrivia + 1;
            updateTrivia();
        }
    </script>
</body>

</html>