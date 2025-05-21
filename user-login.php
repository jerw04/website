<?php
session_start(); // Start the session
require("Connection.php");

$error_message = ""; 

if (isset($_POST['SignIn'])) {
    // Use prepared statements to prevent SQL injection
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $con->prepare("SELECT * FROM `user` WHERE `username` = ? AND `password` = ?");
    $stmt->bind_param("ss", $username, $password); // Bind parameters

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['UserLoginId'] = $username; // Set session variable for user
        header("Location: user-dashboard.php"); // Redirect to dashboard
        exit(); // Always exit after header redirection
    } else {
        $error_message = "Invalid username or password. Please try again.";
    }

    $stmt->close();
}
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-size: cover;
            flex-direction: column;
        }

        .login-container {
            background: linear-gradient(180deg, #bfa76a, #e6d8a7, #bfa76a);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 100%;
            backdrop-filter: blur(10px);
            color: #000; /* Set text color inside the container to black */
        }

        .login-container h2 {
            text-align: center;
            color: #000000; /* Black color for the heading */
            margin-bottom: 30px;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group i {
            position: absolute;
            left: -19px;
            top: 12px;
            color: #d4af37; /* Gold for icon */
        }

        .input-group input {
            width: 100%;
            padding: 12px 12px 10px 3px;
            border: 1px solid #d4af37; /* Gold border */
            border-radius: 5px;
            background-color: #000000; /* Black background for input */
            font-size: 16px;
            color: #ffffff;
            transition: 0.3s;
        }

        .input-group input::placeholder {
            color: #808080; /* Grey placeholder text */
        }

        .input-group input:focus {
            border-color: #ffffff;
            outline: none;
            background-color: #000000; /* Keep black background on focus */
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #000000; /* Black background */
            color: #ffffff; /* White text */
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background-color: #333333; /* Darker black on hover */
        }

        .error {
            color: black; /* Red for error messages */
            font-size: 14px;
            margin-bottom: 15px;
            display: block;
            text-align: center;
        }

        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #000000; /* Black color for forgot password link */
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #d4af37; /* Gold for footer */
        }

        .footer a {
            color: #d4af37;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="login-container">
        <h2>User Login</h2>

        <!-- Display PHP error message -->
        <?php if ($error_message): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <button type="submit" name="SignIn" class="login-btn">Login</button>
        </form>

        <div class="forgot-password">
            <a href="#">Forgot Password?</a>
        </div>

        <div class="footer">
            <p>&copy; 2024 Car Rentals. All rights reserved. <a href="#">Privacy Policy</a></p>
        </div>
    </div>
</body>
</html>
