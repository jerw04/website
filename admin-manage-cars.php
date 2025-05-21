<?php
require("Connection.php");

// Fetch pending rental requests from the database
$pendingRequestsQuery = "SELECT rr.*, rc.expected_rent FROM rental_requests rr 
                        JOIN rentable_cars rc ON rr.car_id = rc.car_id 
                        WHERE rr.rental_status = 'pending'";
$pendingRequestsResult = $con->query($pendingRequestsQuery);

// Handle form submission for confirming rental requests
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_rent'])) {
    $carId = $_POST['car_id'];
    $username = $_POST['username'];

    // Update the rental request status to 'confirmed'
    $stmt = $con->prepare("UPDATE rental_requests SET rental_status = 'confirmed' WHERE car_id = ? AND username = ?");
    $stmt->bind_param("is", $carId, $username);
    $stmt->execute();
    $stmt->close();
}

// Fetch cars from registered_cars and rentable_cars (this is already present)
$carsQuery = "SELECT * FROM registered_cars";
$carsResult = $con->query($carsQuery);

$rentableCarsQuery = "SELECT * FROM rentable_cars";
$rentableCarsResult = $con->query($rentableCarsQuery);

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #bfa76a;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 2px solid #e6d8a7;
            border-radius: 10px;
            background-color: #2e2e2e;
            margin-top: 120px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #bfa76a;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #bfa76a;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
        }
        .action-buttons input {
            margin: 0 5px;
        }
        .confirm-button {
            background-color: green;
            color: white;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?> 

<div class="container">
    <h1>Manage Cars</h1>

    <h2>Pending Rental Requests</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Car ID</th>
                <th>Expected Rent</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($request = $pendingRequestsResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $request['username']; ?></td>
                    <td><?php echo $request['car_id']; ?></td>
                    <td>₹<?php echo $request['expected_rent']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="car_id" value="<?php echo $request['car_id']; ?>">
                            <input type="hidden" name="username" value="<?php echo $request['username']; ?>">
                            <input type="submit" name="confirm_rent" value="Confirm Rent" class="confirm-button">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Other sections like Pending Cars and Rentable Cars -->
</div>

</body>
</html>
