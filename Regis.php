<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Font Awesome -->
    <style>
        /* Your CSS styles from the original code */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* Ensures consistent box sizing */
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

        .registration-box {
            background-color: #a96b57;
            padding: 50px;
            border-radius: 10px;
            width: 500px;
            text-align: left;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .registration-box h2 {
            margin-bottom: 20px;
        }

        .signin {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .registration-box a {
            color: #f1e0d6;
            text-decoration: none;
        }

        .registration-box a:hover {
            text-decoration: underline;
        }

        .registration-box form {
            margin-bottom: 20px;
        }

        .registration-box label {
            display: block;
            margin: 10px 0 5px;
            color: #f1e0d6;
        }

        .registration-box input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #e5d2c7;
        }

        .registration-box button {
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

        .registration-box button:hover {
            background-color: #333;
        }

        .signin-link {
            text-align: center;
            margin-top: 15px;
        }

        .signin-link a {
            color: #f1e0d6;
            text-decoration: none;
        }

        .signin-link a:hover {
            text-decoration: underline;
        }

        /* Modal styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
            padding-top: 100px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
            max-width: 400px;
            /* Maximum width */
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            /* Shadow effect */
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        function showModal() {
            document.getElementById("successModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("successModal").style.display = "none";
        }

        // Close modal when clicking outside of it
        window.onclick = function (event) {
            const modal = document.getElementById("successModal");
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</head>

<body>
    <div class="background-image">
        <div class="registration-box">
            <h2>Sign Up</h2>
            <div class="signin">
                <p></p>
            </div>

            <?php
            // Database connection parameters
            $servername = "localhost"; // Change if necessary
            $username = "root"; // Your database username
            $password = ""; // Your database password
            $dbname = "CraffeDB"; // Your database name
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Initialize variables to hold user input and error messages
            $username = $email = $password = $confirm_password = "";
            $error = "";
            $success = false; // To track registration success
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Validate input
                if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirm-password"])) {
                    $error = "All fields are required.";
                } else {
                    // Sanitize user inputs
                    $username = htmlspecialchars($_POST["username"]);
                    $email = htmlspecialchars($_POST["email"]);
                    $password = htmlspecialchars($_POST["password"]);
                    $confirm_password = htmlspecialchars($_POST["confirm-password"]);

                    // Validate password confirmation
                    if ($password !== $confirm_password) {
                        $error = "Passwords do not match.";
                    } else {
                        // Check if username or email already exists
                        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
                        $stmt->bind_param("ss", $username, $email);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $error = "Username or email already exists.";
                        } else {
                            // Hash the password
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                            // Insert the new user into the database
                            $stmt = $conn->prepare("INSERT INTO register (username, email, password) VALUES (?, ?, ?)");
                            $stmt->bind_param("sss", $username, $email, $hashed_password);

                            if ($stmt->execute()) {
                                // Registration successful
                                $success = true; // Set success flag
                            } else {
                                $error = "Error: " . $stmt->error;
                            }
                        }
                        $stmt->close();
                    }
                }
            }

            // Close connection
            $conn->close();
            ?>

            <!-- Display error message if there is one -->
            <?php if (!empty($error)): ?>
                <p style="color:red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <!-- Display success message if registration is successful -->
            <?php if ($success): ?>
                <script>
                    showModal(); // Show the modal on successful registration
                </script>
            <?php endif; ?>

            <!-- Form submission handled by the same PHP script -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>

                <button type="submit">Create Account</button>
            </form>

            <div class="signin-link">
                <a href="login.php">Already have an account? Sign In</a>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Success!</h2>
            <p>Registration successful!</p>
            <button onclick="closeModal()">Close</button>
        </div>
    </div>
</body>

</html>