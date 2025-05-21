<?php
    require("Connection.php");
    $error_message = "";
    if (isset($_POST['SignIn'])) {
        $query = "SELECT * FROM `admin` WHERE `username`='$_POST[username]' AND `password`='$_POST[password]'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['AdminLoginId'] = $_POST['username'];
            header("Location: admin-dashboard.php");
            exit();
        } else {
            $error_message = "Invalid username or password. Please try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
    background: linear-gradient(180deg, #c0c0c0, #e6e6e6, #c0c0c0); /* Silver gradient */
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
    color: black; 
}

.input-group input {
    width: 100%;
    padding: 12px 12px 10px 3px;
    border: 1px solid #c0c0c0; /* Silver border */
    border-radius: 5px;
    background-color: #000000; /* Black background for input */
    font-size: 16px;
    color: #ffffff; /* White text for input */
    transition: 0.3s;
}

.input-group input::placeholder {
    color: #808080; /* Grey placeholder text */
}

.input-group input:focus {
    border-color: #ffffff; /* White border on focus */
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
    color: black; /* Black for error messages */
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
    color: #c0c0c0; /* Silver for footer text */
    background-color: #000000; /* Black background */
    padding: 10px; /* Padding for space inside the box */
    border-radius: 5px; /* Rounded corners */
}

.footer a {
    color: #c0c0c0; /* Silver for footer link */
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


        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            opacity: 0.15;
            background: url('https://images.unsplash.com/photo-1563298720-4a5926d0b9a3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDN8fGJhY2tncm91bmR8ZW58MHx8fHwxNjg1NjY5ODg4&ixlib=rb-1.2.1&q=80&w=1080') no-repeat center center;
            background-size: cover;
        }

    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="background-image"></div>
    
    <div class="login-container">
        <h2>Admin Login</h2>

        <!-- Display PHP error message -->
        <?php if ($error_message): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form method="POST" onsubmit="return validateLogin()">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <div id="username-error" class="error" style="display:none;">Username is required</div>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required autocomplete="off">
                <div id="password-error" class="error" style="display:none;">Password is required</div>
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

    <script>
        function validateLogin() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const usernameError = document.getElementById('username-error');
            const passwordError = document.getElementById('password-error');

            let isValid = true;

            if (username === "") {
                usernameError.style.display = "block";
                isValid = false;
            } else {
                usernameError.style.display = "none";
            }

            if (password === "") {
                passwordError.style.display = "block";
                isValid = false;
            } else {
                passwordError.style.display = "none";
            }

            return isValid;
        }
    </script>

</body>
</html>
