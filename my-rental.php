<?php
require("Connection.php");

$error_message = ""; 
$rental_requests = []; // Array to hold rental requests

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get car_id from the form input
    $car_id = isset($_POST['car_id']) ? $_POST['car_id'] : '';

    if ($car_id) {
        // Fetch rental requests for the specified car_id
        $stmt = $con->prepare("SELECT username, rental_status FROM rental_requests WHERE car_id = ?");
        $stmt->bind_param("s", $car_id); // Bind as string for alphanumeric
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $rental_requests[] = $row; // Add each request to the array
        }

        $stmt->close();
    } else {
        $error_message = "Please enter a valid Car ID.";
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Rental Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c1c;
            color: white;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #bfa76a;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 2px solid #e6d8a7;
            border-radius: 10px;
            background-color: #2e2e2e;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
        .input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .input-group input {
            flex: 1;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #bfa76a;
            background-color: #333; /* Darker background for input */
            color: white; /* White text for input */
        }
        .input-group button {
            padding: 10px;
            background-color: #bfa76a;
            border: none;
            color: black;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .input-group button:hover {
            background-color: #e6d8a7;
        }
        .request-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #444;
        }
        /* Status color classes */
        .status-confirmed {
            color: green; /* Green for confirmed */
        }
        .status-pending {
            color: yellow; /* Yellow for pending */
        }
        .status-rejected {
            color: red; /* Red for rejected */
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h1>View Rental Requests</h1>

    <form method="POST">
        <div class="input-group">
            <input type="text" name="car_id" placeholder="Enter Car ID" required>
            <button type="submit">Submit</button>
        </div>
        <?php if ($error_message): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </form>

    <div>
        <?php if (!empty($rental_requests)): ?>
            <h3>Status Overview</h3>
            <?php foreach ($rental_requests as $request): ?>
                <div class="request-item">
                    <strong><?php echo htmlspecialchars($request['username']); ?></strong>
                    <span class="status-<?php echo htmlspecialchars($request['rental_status']); ?>">
                        <?php echo htmlspecialchars(ucfirst($request['rental_status'])); ?>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No rental requests found for this Car ID.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
