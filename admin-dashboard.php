<?php
    session_start();
    if(isset($_POST['logout'])) {
        session_destroy();
        header("location: admin-login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    margin-left: 90em;
    margin-top: -1000px;
}

.logout-button:hover {
    background-color: #c0392b;
}

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        

        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 30px;
        }

        .dashboard-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            position: relative;
            text-decoration: none;
            color: inherit;
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
            background-color: #34495e;
            color: white;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
        }

        /* Tooltip for icons */
        .dashboard-card [title] {
            position: relative;
        }
        .dashboard-card [title]:hover:after {
            content: attr(title);
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #2c3e50;
            color: white;
            padding: 5px;
            border-radius: 5px;
            white-space: nowrap;
            font-size: 12px;
            opacity: 0.9;
        }
  
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="navbar">
        
        
        <div ><h1>Welcome, <?php echo isset($_SESSION['AdminLoginId']) ? $_SESSION['AdminLoginId'] : 'Guest'; ?>
            <form method="POST">
                <button name="logout" class="logout-button">Logout</button></h1>
            </form>
        </div>
        
    </div>

    <div class="dashboard-container">
        <a href="manage-users.html" class="dashboard-card">
            <i class="fas fa-users" title="Manage Users"></i>
            <h2>Manage Users</h2>
            <p>View and manage users.</p>
        </a>
        <a href="admin-manage-cars.php" class="dashboard-card">
            <i class="fas fa-car" title="Manage Cars"></i>
            <h2>Manage Cars</h2>
            <p>View and manage car listings.</p>
        </a>
        <a href="reports.php" class="dashboard-card">
            <i class="fas fa-chart-bar" title="Reports"></i>
            <h2>Reports</h2>
            <p>View system reports.</p>
        </a>
    </div>

    <div class="footer">
        <p>&copy; 2024 Car Rentals. All rights reserved.</p>
    </div>

</body>
</html>
