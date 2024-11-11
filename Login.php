<?php
// Database connection
$servername = "localhost";  // Replace with your database server name
$dbUsername = "root"; // Replace with your DB username
$dbPassword = ""; // Replace with your DB password
$dbname = "CraffeDB"; // The name of your database

// Initialize error message
$error = '';

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect input data
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // Prepare and bind statement to check if the user exists
    $stmt = $conn->prepare("SELECT password FROM register WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        // User exists, now verify the password
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Redirect on successful login
            header('Location: Craffe.php');
            exit;
        } else {
            // Set error message for incorrect login
            $error = 'Invalid username or password. Please try again.';
        }
    } else {
        // User does not exist
        $error = 'Invalid username or password. Please try again.';
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Font Awesome -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Alfa Slab One', sans-serif;
            background-color: #fff;
        }

        .background-image {
            background: url('assets/images/bg2.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .login-box {
            background-color: #a96b57;
            padding: 50px;
            border-radius: 10px;
            width: 500px;
            text-align: left;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .login-box h2 {
            margin-bottom: 20px;
        }

        .signup {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .login-box a {
            color: #f1e0d6;
            text-decoration: none;
        }

        .login-box a:hover {
            text-decoration: underline;
        }

        .login-box form {
            margin-bottom: 20px;
        }

        .login-box label {
            display: block;
            margin: 10px 0 5px;
            color: #f1e0d6;
        }

        .login-box input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #e5d2c7;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember {
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .remember input[type="checkbox"] {
            margin-right: 5px;
            transform: scale(1.2);
            margin-top: 12px;
        }

        .remember label {
            line-height: 1;
            margin: 0;
        }

        .login-box button {
            padding: 8px;
            width: 150px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        .login-box button:hover {
            background-color: #333;
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #f1e0d6;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        /* Modal styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1000;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            backdrop-filter: blur(5px);
            /* Blurring effect on background */
        }

        .modal-content {
            background-color: #fff;
            /* White background for the modal */
            margin: 10% auto;
            /* Center the modal */
            padding: 20px;
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            /* Shadow effect */
            width: 90%;
            /* Width of modal */
            max-width: 400px;
            /* Max width of modal */
            animation: slideIn 0.5s;
            /* Animation effect */
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close {
            color: #ff6b6b;
            /* Color of the close button */
            float: right;
            font-size: 28px;
            font-weight: bold;
            transition: color 0.3s;
            /* Smooth transition for hover */
        }

        .close:hover,
        .close:focus {
            color: #ff3b3b;
            /* Darker shade on hover */
            text-decoration: none;
            cursor: pointer;
        }

        #errorMessage {
            color: #333;
            /* Text color */
            font-size: 16px;
            /* Font size */
            text-align: center;
            /* Centered text */
        }
    </style>
</head>

<body>
    <div class="background-image">
        <div class="login-box">
            <h2>Login</h2>
            <div class="signup">
                <p>Don't have an account?</p>
                <a href="Regis.php">Sign Up</a> <!-- Updated Sign Up link -->
            </div>

            <!-- Display error message if exists -->
            <?php if ($error): ?>
                <script>
                    // Show notification in case of error
                    window.onload = function () {
                        document.getElementById('errorMessage').style.display = 'block';
                    };
                </script>
            <?php endif; ?>

            <form method="POST" action="">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <div class="remember-forgot">
                    <div class="remember">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                </div>

                <button type="submit">LOGIN</button>

                <div class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="errorModal" class="modal" style="display: <?php echo $error ? 'block' : 'none'; ?>">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <p id="errorMessage"><?php echo $error; ?></p>
        </div>
    </div>

    <!-- Error notification section -->
    <div id="errorNotification"
        style="display: none; background-color: #f44336; color: white; padding: 15px; text-align: center; border-radius: 5px; position: fixed; top: 10px; left: 50%; transform: translateX(-50%); width: 300px;">
        Invalid username or password. Please try again.
    </div>

    <script>
        document.getElementById('closeModal').onclick = function () {
            document.getElementById('errorModal').style.display = 'none';
        }

        window.onclick = function (event) {
            var modal = document.getElementById('errorModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        // JavaScript to show notification
        window.onload = function () {
            <?php if ($error): ?>
                var errorNotification = document.getElementById('errorNotification');
                errorNotification.style.display = 'block';

                // Hide the notification after 5 seconds
                setTimeout(function () {
                    errorNotification.style.display = 'none';
                }, 5000);
            <?php endif; ?>
        };
    </script>
</body>

</html>