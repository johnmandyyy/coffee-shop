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
        body {
            margin: 0;
            padding: 0;
            min-height: 200vh;
            display: flex;
            flex-direction: column;
            background-color: ghostwhite;
            color: black;
            font-family: 'Alfa Slab One', sans-serif;
            overflow-x: hidden;

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


        /* Splash and photos section */
        .splash-container {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            margin-bottom: ;
        }

        .splash-photo {
            position: absolute;
            top: 47%;
            left: 70%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: auto;
            max-width: 1200px;
            overflow: hidden;
            opacity: 0.8;
        }

        .photo1,
        .photo2,
        .photo3 {
            position: absolute;
            height: auto;
            overflow: hidden;
        }

        .photo1,
        .photo2 {
            position: absolute;
            height: auto;
            /* Maintain aspect ratio */
        }

        .photo1 {
            top: 30%;
            /* Position vertically */
            left: 53%;
            /* Position horizontally */
            width: 20%;
            /* Initial size */
            transform: rotate(-25deg);
            /* Adjust for rotation */
            z-index: 3;
            /* Stack order */
        }

        .photo2 {
            top: 21.5%;
            /* Position vertically */
            left: 61%;
            /* Position horizontally */
            width: 25%;
            /* Initial size */
            transform: rotate(22deg);
            /* Adjust for rotation */
            z-index: 3;
            /* Stack order */
        }

        .photo1 img,
        .photo2 img {
            width: 100%;
            /* Make images responsive */
            height: auto;
            /* Maintain aspect ratio */
            overflow: hidden;
        }

        .photo3 {
            width: 30vw;
            top: 67.5vh;
            left: 54vw;
            z-index: 2;
            opacity: 0.7;
            position: absolute;
            overflow: hidden;

        }

        /* Overlay section */
        .overlay {
            position: absolute;
            top: 40%;
            left: 10%;
            z-index: 0;
            color: #AB886D;
            font-size: 2em;
            text-align: left;
            font-family: 'Alfa Slab One', sans-serif;
        }

        .overlay h2 {
            font-size: 3em;
            margin: 0;

        }

        .overlay p {
            margin-top: 0px;
            font-size: 0.8em;
            color: #AB886D;
        }

        .buy-now {
            position: absolute;
            top: 102%;
            left: 67%;
            transform: translate(-50%, -50%);
            display: inline-block;
            padding: 15px 30px;
            width: 95px;
            background-color: #AB886D;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 25px;
            transition: background-color 0.3s ease;
            transform: 0.3s ease;
            font-family: Lato;
            font-size: 1.5em;
            z-index: 10;
            overflow: hidden;

        }

        .buy-now::after {
            content: '';
            position: absolute;
            background-color: brown;
            left: 0;
            top: 0;
            border-radius: 25px;
            z-index: -1;
            transition: transform 0.3s ease;
            transform: scale(0);
        }

        .buy-now:hover::after {
            transform: scale(1);
        }

        .buy-now:hover {
            background-color: #007acc;


        }

        .explore-section {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 70px 40px;
            background-color: #8c6a5d;
            width: 80%;
            max-width: 1200px;
            margin: 50px auto;
            border-radius: 20px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 10);
            gap: 60px;
            flex-direction: row-reverse;
            transition: transform 0.3s ease, background-color 0.3s ease;
            text-decoration: none;
            z-index: 1;

        }

        .explore-image-box {
            position: relative;
            width: 500px;
            height: 500px;
            overflow: hidden;
            border-radius: 70%;
            border: 5px solid black;
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0);
        }

        .explore-image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 70%;
            background-color: white;
        }

        .explore-menu {
            text-align: left;
        }

        .explore-menu h2 {
            margin: 0 0 15px 0;
            font-size: 2.5em;
            color: white;
        }

        .explore-menu p {
            margin: 0 0 30px 0;
            font-size: 1.2em;
            color: white;
        }

        .explore-button {
            display: inline-block;
            padding: 10px 30px;
            background-color: black;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 50px;
            transition: background-color 0.3s ease;
            font-family: Lato;

        }

        .explore-button:hover {
            background-color: #007acc;
        }

        .photo4 {
            position: absolute;
            /* Position it absolutely */
            top: 146%;
            /* Distance from the top of the parent container */
            left: 67%;
            /* Distance from the left of the parent container */
            /* Optional: Use width and margin for responsive design */
            width: 67%;
            /* Set a fixed width or use percentage */
            height: auto;
            /* Maintain aspect ratio */
            transform: rotate(25deg);
            z-index: 2;

        }

        .photo4 img {
            width: 30%;
            /* Make image fill the container */
            height: auto;
            /* Maintain aspect ratio */
            overflow: hidden;

        }


        .about-us-container {
            display: flex;
            justify-content: space-between;
            /* Align text and image side by side */
            align-items: center;
            padding: 70px 40px;
            background-color: #8c6a5d;
            width: 80%;
            max-width: 1200px;
            margin: 180px auto;
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, background-color 0.3s ease;
            text-decoration: none;
            overflow: hidden;
            margin-bottom: 100px;

        }

        .about-us-content {
            text-align: center;
            /* Align the text to the left */
            color: white;
            margin-top: 100px;
            flex: 1;
            /* Allow content to take up space next to the image */
            margin-right: 20px;
            /* Add some space between text and image */
        }

        .about-us-content h2 {
            font-size: 3em;
            margin-top: 50px;
            margin-bottom: 30px;
            color: white;
            text-align: center;
        }

        .about-us-content p {
            font-size: 1.5em;
            margin-bottom: 30px;
            color: white;
            text-align: left;
            /* Align text to the left */
            text-indent: 0;
            /* Remove indentation */
        }

        .about-us-content a {
            display: inline-block;
            padding: 10px 30px;
            background-color: black;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 50px;
            transition: background-color 0.3s ease;
            font-family: Lato;
        }

        .about-us-content a:hover {
            background-color: #007acc;
        }

        .about-image {
            flex: 1;
            /* Allow the image to take up space next to the content */
            text-align: center;
        }

        .about-image img {
            width: 400px;
            /* Adjust the size of the image */
            height: auto;
            /* Keep aspect ratio */
            border-radius: 50%;
            /* Make image circular */
            border: 5px solid white;
            /* Add a white border for better look */
        }

        .photo5 {

            position: absolute;
            /* Position it absolutely */
            top: 152%;
            /* Distance from the top of the parent container */
            left: 10%;
            /* Distance from the left of the parent container */
            /* Optional: Use width and margin for responsive design */
            width: 80%;
            /* Set a fixed width or use percentage */
            height: auto;
            /* Maintain aspect ratio */
            transform: rotate(-25deg);
            overflow: hidden;
        }

        .photo5 img {
            width: 100%;
            /* Make photo5 responsive */
            max-width: 400px;
            /* Set a max-width */
            height: auto;
            /* Maintain aspect ratio */
            overflow: hidden;
        }




        .feedback-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 70px 40px;
            background-color: #8c6a5d;
            width: 80%;
            max-width: 1200px;
            margin: 50px auto;
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, background-color 0.3s ease;
            text-decoration: none;
            margin-bottom: 150px;


        }

        .feedback-content {
            text-align: center;
            color: white;
            flex: 1;
        }

        .feedback-content h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: white;
        }

        .feedback-content p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: white;
            text-indent: 35px;
        }

        .feedback-content a {
            display: inline-block;
            padding: 10px 30px;
            background-color: black;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 50px;
            transition: background-color 0.3s ease;
            font-family: Lato;
        }

        .feedback-content a:hover {
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


            @media (max-width: 480px) {
                .footer-logo img {
                    width: 80px;
                }

                .social-icons img {
                    width: 30px;
                    height: 30px;
                }

                .footer-section h4 {
                    font-size: 1em;
                }

                .footer-section p,
                .footer-section a {
                    font-size: 0.8em;
                }
            }

            @media (max-width: 768px) {
                .feedback-container {

                    width: 90%;
                }


                @media (max-width: 768px) {
                    .about-us-container {
                        flex-direction: column;
                        /* Stack items vertically on small screens */
                        padding: 50px 30px;
                        width: 90%;
                    }

                    .about-us-content {
                        margin-right: 0;
                        text-align: center;
                        /* Center text on smaller screens */
                    }

                    .about-image img {
                        width: 250px;
                        /* Adjust image size for smaller screens */
                    }

                    .photo5 img {
                        max-width: 300px;
                        /* Adjust image size for smaller screens */
                    }
                }


                @media (max-width: 768px) {
                    .explore-section {
                        flex-direction: column;
                        /* Stack items vertically on smaller screens */
                    }

                    .photo4 {
                        margin: 10px 0;
                        /* Adjust margin for smaller screens */
                        width: 80%;
                        /* Make it narrower on smaller screens */
                    }

                    /* Media Queries for Responsiveness */
                    @media (max-width: 1024px) {
                        .explore-section {
                            flex-direction: column;
                            gap: 30px;
                            padding: 50px 20px;
                        }

                        .explore-image-box {
                            width: 350px;
                            height: 350px;
                        }

                        .explore-menu h2 {
                            font-size: 2em;
                        }

                        .explore-menu p {
                            font-size: 1em;
                        }


                        @media (max-width: 768px) {
                            .explore-section {
                                width: 90%;
                                padding: 40px 20px;
                            }

                            .explore-image-box {
                                width: 300px;
                                height: 300px;
                            }

                            .explore-menu h2 {
                                font-size: 1.8em;
                            }

                            .explore-menu p {
                                font-size: 0.9em;
                            }


                            @media (max-width: 480px) {
                                .explore-section {
                                    width: 100%;
                                    padding: 30px 15px;
                                }

                                .explore-image-box {
                                    width: 250px;
                                    height: 250px;
                                }

                                .explore-menu h2 {
                                    font-size: 1.5em;
                                }

                                .explore-menu p {
                                    font-size: 0.8em;
                                }

                                .explore-button {
                                    padding: 8px 20px;
                                }

                                @media (max-width: 768px) {
                                    .buy-now {
                                        font-size: 0.9em;
                                        /* Adjust font size */
                                        padding: 8px 16px;
                                        /* Adjust padding */
                                    }


                                    @media (max-width: 480px) {
                                        .buy-now {
                                            font-size: 0.8em;
                                            /* Further adjust font size */
                                            padding: 6px 12px;
                                            /* Further adjust padding */
                                        }

                                        @media (max-width: 1024px) {

                                            .photo1,
                                            .photo2 {
                                                width: 20%;
                                                /* Adjust for medium screens */
                                            }


                                            @media (max-width: 768px) {

                                                .photo1,
                                                .photo2 {
                                                    width: 15%;
                                                    /* Adjust for mobile screens */
                                                }

                                                @media (max-width: 1024px) {
                                                    .splash-photo {
                                                        width: 60%;
                                                        /* Reduce width for smaller devices */
                                                        max-width: 500px;
                                                        /* Adjust as needed */
                                                    }

                                                    @media (max-width: 768px) {
                                                        .buy-now {
                                                            font-size: 0.9em;
                                                            /* Adjust font size */
                                                            padding: 8px 16px;
                                                            /* Adjust padding */
                                                        }

                                                        @media (max-width: 480px) {
                                                            .buy-now {
                                                                font-size: 0.8em;
                                                                /* Further adjust font size */
                                                                padding: 6px 12px;
                                                                /* Further adjust padding */
                                                            }

                                                            @media (max-width: 768px) {
                                                                .photo3 {
                                                                    width: 50%;
                                                                    /* Adjust width for smaller screens */
                                                                    top: 70%;
                                                                    /* Adjust position */
                                                                    left: 40%;
                                                                }


                                                                /* Media query for very small screens (phones) */
                                                                @media (max-width: 480px) {
                                                                    .photo3 {
                                                                        width: 70%;
                                                                        top: 75%;
                                                                        left: 20%;
                                                                    }




                                                                    /* For small screens (mobile devices) */
                                                                    @media (max-width: 768px) {


                                                                        .splash-photo {
                                                                            width: 50%;
                                                                            /* Further reduce width */
                                                                            max-width: 400px;
                                                                        }



                                                                        /* Media queries for responsiveness */
                                                                        @media (max-width: 768px) {
                                                                            header {
                                                                                height: auto;
                                                                                padding: 10px;
                                                                            }

                                                                            .logo img {
                                                                                width: 80px;
                                                                            }

                                                                            .logo-text {
                                                                                font-size: 1.2em;
                                                                            }

                                                                            .icons {
                                                                                top: 10px;
                                                                                right: 10px;
                                                                                gap: 5px;
                                                                            }

                                                                            .profile-icon {
                                                                                width: 40px;
                                                                                height: 40px;
                                                                            }

                                                                            .cart-icon {
                                                                                width: 30px;
                                                                                height: 30px;
                                                                            }

                                                                            .sections-container {
                                                                                flex-direction: column;
                                                                            }

                                                                            .section {
                                                                                margin: 10px 0;
                                                                            }

                                                                            .section a {
                                                                                font-size: 1em;
                                                                                padding: 5px 10px;
                                                                            }


                                                                            .overlay {
                                                                                font-size: 2em;
                                                                                top: 15%;
                                                                            }

                                                                            .overlay p {
                                                                                font-size: 1em;
                                                                            }
                                                                        }

                                                                        @media (max-width: 480px) {
                                                                            .logo img {
                                                                                width: 60px;
                                                                            }

                                                                            .logo-text {
                                                                                font-size: 1em;
                                                                            }

                                                                            .icons {
                                                                                top: 5px;
                                                                                right: 5px;
                                                                            }

                                                                            .profile-icon {
                                                                                width: 30px;
                                                                                height: 30px;
                                                                            }

                                                                            .cart-icon {
                                                                                width: 25px;
                                                                                height: 25px;
                                                                            }

                                                                            .section a {
                                                                                font-size: 0.9em;
                                                                                padding: 5px 10px;
                                                                            }

                                                                            .sections-container {
                                                                                flex-direction: column;
                                                                                align-items: flex-start;
                                                                            }


                                                                            .overlay {
                                                                                font-size: 1.8em;
                                                                                top: 10%;
                                                                            }

                                                                            .overlay p {
                                                                                font-size: 0.9em;
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

    <div class="splash-container">
        <img src="assets/images/Splash-removebg-preview.png" alt="Splash Image" class="splash-photo">
    </div>

    <div class="photo1">
        <img src="assets/images/Beans-removebg-preview.png" alt="Black Coffee Cup">
    </div>
    <div class="photo2">
        <img src="assets/images/Matcha-removebg-preview.png" alt="Green Coffee Cup">
    </div>
    <div class="photo3">
        <img src="assets/images/shadoow.png" alt="Shadow Image">
    </div>
    <a href="<?php echo $menuLink; ?>" class="buy-now">Buy Now</a>



    <div class="overlay">
        <h2>Another Day,<br>Another Cup<br>of Coffee</h2>
        <p>Life begins after coffee.</p>
    </div>

    <div class="explore-section">
        <div class="explore-menu">
            <h2>Craffé Menu</h2>
            <p>Discover your new favorites that will get you going throughout the day.</p>
            <a href="<?php echo $menuLink; ?>" class="explore-button">Explore Menu</a>
        </div>

        <div class="explore-image-box">
            <img src="assets/images/Logoo.png" alt="Explore Image">
        </div>
    </div>
    <div class="photo4">
        <img src="assets/images/pic5.png" alt="Coffee Image 4">
    </div>

    <div class="about-us-container">
        <div class="about-us-content">
            <h2>About Us</h2>
            <p>Discover the story behind Craffé and our mission to bring the finest coffee experience to our customers.
            </p>
            <a href="<?php echo $aboutLink; ?>">Learn More</a>
        </div>
        <div class="about-image">
            <img src="assets/images/awr.jpg" alt="Craffé MYCC Image"> <!-- Place your awr.jpg here -->
        </div>
    </div>
    <div class="photo5">
        <img src="assets/images/photo5.png" alt="Coffee Image 4">
    </div>

    <div class="feedback-container">
        <!-- Text Content -->
        <div class="feedback-content">
            <h2>Feedback</h2>
            <p>We value your input! Share your thoughts and help us improve your experience at Craffé.</p>
            <a href="<?php echo $feedbackLink; ?>">Give Feedback</a>
        </div>
    </div>

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

</body>

</html>