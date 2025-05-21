<?php
require('Connection.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$successMessage = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $accountType = $_POST['accountType'];

    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Check if username is unique across both tables
        $checkUserQuery = "SELECT username FROM user WHERE username = ?";
        $checkAdminQuery = "SELECT username FROM admin WHERE username = ?";
        
        $stmtUser = $con->prepare($checkUserQuery);
        $stmtUser->bind_param("s", $username);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result();
        
        $stmtAdmin = $con->prepare($checkAdminQuery);
        $stmtAdmin->bind_param("s", $username);
        $stmtAdmin->execute();
        $resultAdmin = $stmtAdmin->get_result();
        
        if ($resultUser->num_rows > 0 || $resultAdmin->num_rows > 0) {
            $error = "Username already taken. Please choose another.";
        } else {
           
            if ($accountType === "user") {
                $insertQuery = "INSERT INTO user (username, password) VALUES (?, ?)";
                $redirectPage = "user-login.php";
            } else {
                $insertQuery = "INSERT INTO admin (username, password) VALUES (?, ?)";
                $redirectPage = "admin-login.php";
            }
            
            $stmt = $con->prepare($insertQuery);
            $stmt->bind_param("ss", $username, $password);

            if ($stmt->execute()) {
                // Set success message
                $successMessage = "Dear $username, your account has been created successfully!<br> PLEASE WAIT FOR FEW MINUTES WHILE WE REDIRECT YOU!";
                header("refresh:7; url=$redirectPage");
            } else {
                $error = "Error creating account. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lobster:wght@400;700&display=swap">
    <link rel="stylesheet" href="styles.css">
    <style>
        .form-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #222;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.6);
            color: #e0e0e0;
            margin-top: 70px;
            text-align: center;
        }

        .form-container h2 {
            color: #d4af37;
            font-family: 'Lora', serif;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
            color: #d4af37;
        }

        .form-container input, .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #333;
            color: #e0e0e0;
            border: none;
            border-radius: 5px;
        }

        .success, .error {
            color: #d4af37;
            margin-top: 10px;
        }

        .success-message {
            margin-top: 20px;
            color: #d4af37;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            border: 2px solid #d4af37;
            border-radius: 8px;
            background-color: #333;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="form-container">
        <?php if ($successMessage): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php else: ?>
            <form method="POST" action="create-account.php">
                <h2>Create an Account</h2>
                <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
                
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" required>
                </div>
                
                <div class="form-group">
                    <label for="accountType">Account Type:</label>
                    <select name="accountType" id="accountType" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                
                <button type="submit" class="s-btn--scooter-bg">Sign Up</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
