<?php
    session_start();
    if(isset($_POST['logout'])) {
        session_destroy();
        header("location: user-login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        

        .logout-button {
            padding: 10px 20px;
            background-color: #e74c3c;
            color: #ffffff;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 20px 10px rgba(0, 0, 0, 0.1);
            margin-left: 90em;
        }

        .logout-button:hover {
            background-color: #c0392b;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-0.5px);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 30px;
        }

        .dashboard-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 20px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .dashboard-card i {
            font-size: 40px;
            color: #2980b9;
            margin-bottom: 10px;
        }

        .dashboard-card h2 {
            font-size: 24px;
            margin: 0;
            color: #333;
        }

        .dashboard-card p {
            margin: 10px 0 0;
            color: #7f8c8d;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <!-- Navbar -->
    <div class="navbar">     
        <h1>Welcome, <?php echo isset($_SESSION['AdminLoginId']) ? $_SESSION['AdminLoginId'] : 'Guest'; ?></h1>
        <form method="POST">
            <button name="logout" class="logout-button">Logout</button>
        </form>
    </div>

    <!-- Dashboard Cards -->
    <div class="dashboard-container">
        <div class="dashboard-card">
            <i class="fas fa-car"></i>
            <h2>Rent a Car</h2>
            <p>Choose from our wide range of cars available for rent.</p>
            <a href="rent-car.php" style="display: block; text-align: center; margin-top: 10px; color: #2980b9;">View Cars</a>
        </div>
        
        <div class="dashboard-card">
            <i class="fas fa-plus-circle"></i>
            <h2>Add Your Car</h2>
            <p>List your car for rent and earn extra income.</p>
            <a href="add-car.php" style="display: block; text-align: center; margin-top: 10px; color: #2980b9;">Add Car</a>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-file-invoice"></i>
            <h2>My Rentals</h2>
            <p>View your current and past rentals.</p>
            <a href="my-rental.php" style="display: block; text-align: center; margin-top: 10px; color: #2980b9;">View Rentals</a>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-comments"></i>
            <h2>Feedback</h2>
            <p>Submit your feedback or read user reviews.</p>
            <a href="feedback.php" style="display: block; text-align: center; margin-top: 10px; color: #2980b9;">Give Feedback</a>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2024 Car Rentals User Dashboard. All Rights Reserved.
    </div>
</body>
</html>
