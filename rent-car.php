<?php
require("Connection.php");

$errorMessage = ""; 

$cars = [];
$result = $con->query("SELECT car_id, name, brand, model, carbon_monoxide_level, car_image, expected_rent FROM registered_cars");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Car</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #bfa76a;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 2px solid #e6d8a7;
            border-radius: 10px;
            background-color: #2e2e2e;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #bfa76a;
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #3e3e3e;
            color: #e6d8a7;
        }
        td {
            background-color: #2e2e2e;
        }
        .car-image {
            width: 100px; 
            height: auto;
            border-radius: 5px;
        }
        .rent-button {
            background-color: #bfa76a;
            color: black;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .rent-button:hover {
            background-color: #e6d8a7;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        /* Modal styles */
        #rentModal {
            display: none; 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(0,0,0,0.8); 
            z-index: 1000; 
            justify-content: center; 
            align-items: center;
        }
        #rentModal div {
            background: #2e2e2e; 
            padding: 20px; 
            border-radius: 10px; 
            width: 300px; 
            text-align: center;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h1>Available Cars for Rent</h1>

    <?php if ($errorMessage): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <?php if (empty($cars)): ?>
        <p>No cars available for rent at the moment.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Car ID</th> <!-- New Car ID Column -->
                    <th>Car Image</th>
                    <th>Owner Name</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>CO Level (ppm)</th>
                    <th>Expected Rent (₹)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($car['car_id']); ?></td> <!-- Displaying Car ID -->
                        <td><img src="<?php echo htmlspecialchars($car['car_image']); ?>" alt="Car Image" class="car-image"></td>
                        <td><?php echo htmlspecialchars($car['name']); ?></td>
                        <td><?php echo htmlspecialchars($car['brand']); ?></td>
                        <td><?php echo htmlspecialchars($car['model']); ?></td>
                        <td><?php echo htmlspecialchars($car['carbon_monoxide_level']); ?></td>
                        <td>₹<?php echo htmlspecialchars($car['expected_rent']); ?></td>
                        <td>
                            <button class="rent-button" onclick="openModal('<?php echo htmlspecialchars($car['car_id']); ?>')">Rent Now</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<div id="rentModal">
    <div>
        <h2 style="color: #bfa76a;">Rent This Car</h2>
        <form id="rentForm" action="rent-request.php" method="post">
            <input type="hidden" name="car_id" id="car_id" value="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required style="width: 100%; padding: 5px; margin: 10px 0;">
            <input type="submit" class="rent-button" value="Submit">
            <button type="button" style="margin-top: 10px; background-color: red; border:0; border-radius:8px;padding: 10px;" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>


<script>
    function openModal(carId) {
        document.getElementById('car_id').value = carId; // Set the car ID in the hidden input
        document.getElementById('rentModal').style.display = 'flex'; // Show the modal
    }

    function closeModal() {
        document.getElementById('rentModal').style.display = 'none'; // Hide the modal
    }
</script>
</body>
</html>
