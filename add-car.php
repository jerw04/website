<?php
require("Connection.php");

// Generate a random car ID
$carId = uniqid('car_'); // Unique ID generation
$errorMessage = ""; // Variable to store error messages
$successMessage = ""; // Variable to store success messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $carbonMonoxideLevel = $_POST['carbon_monoxide_level'];
    $expectedRent = $_POST['expected_rent'];
    
    // Handle image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["car_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["car_image"]["tmp_name"]);
    if ($check === false) {
        $errorMessage .= "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check file size (5MB limit)
    if ($_FILES["car_image"]["size"] > 5000000) {
        $errorMessage .= "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $errorMessage .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $errorMessage .= "Sorry, your file was not uploaded.<br>";
    } else {
        if (move_uploaded_file($_FILES["car_image"]["tmp_name"], $targetFile)) {
            $stmt = $con->prepare("INSERT INTO registered_cars (car_id, name, brand, model, carbon_monoxide_level, car_image, expected_rent) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssi", $carId, $name, $brand, $model, $carbonMonoxideLevel, $targetFile, $expectedRent);

            if ($stmt->execute()) {
                $successMessage = "New car added successfully! Your Car ID is: " . $carId;
            } else {
                $errorMessage .= "Error: " . $stmt->error . "<br>";
            }
            $stmt->close();
        } else {
            $errorMessage .= "Sorry, there was an error uploading your file.<br>";
        }
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
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
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 2px solid #e6d8a7;
            border-radius: 10px;
            background-color: #2e2e2e;
            margin-top: 100px;
        }
        label {
            color: #e6d8a7;
        }
        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #bfa76a;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #bfa76a;
            color: black;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #e6d8a7;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
        .copy-box {
            display: none;
            background-color: #3e3e3e;
            border: 1px solid #bfa76a;
            padding: 15px;
            border-radius: 5px;
            position: relative;
            margin-top: 20px;
        }
        .copy-btn {
            background-color: #bfa76a;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .copy-icon {
            width: 20px; 
            margin-left: 5px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h1>Add New Car</h1>

    <?php if ($errorMessage): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <?php if ($successMessage): ?>
        <div class="success"><?php echo $successMessage; ?></div>
        <div class="copy-box" id="copyBox">
            <p>Your Car ID: <span id="carIdDisplay"><?php echo htmlspecialchars($carId); ?></span></p>
            <button class="copy-btn" onclick="copyToClipboard()">Copy</button>
            
        </div>
        <script>
            document.getElementById('copyBox').style.display = 'block';
        </script>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Owner Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="brand">Car Brand:</label>
        <input type="text" id="brand" name="brand">

        <label for="model">Car Model:</label>
        <input type="text" id="model" name="model">

        <label for="carbon_monoxide_level">CO Level (ppm):</label>
        <input type="number" id="carbon_monoxide_level" name="carbon_monoxide_level" min="0" required>

        <label for="car_image">Car Image:</label>
        <input type="file" id="car_image" name="car_image" accept="image/*" required>

        <label for="expected_rent">Expected Rent (per day in Rs):</label>
        <input type="number" id="expected_rent" name="expected_rent" required>

        <input type="submit" value="Add Car">
    </form>
</div>

<script>
    function copyToClipboard() {
        const carId = document.getElementById('carIdDisplay').innerText;
        navigator.clipboard.writeText(carId)
            .then(() => {
                alert('Car ID copied to clipboard: ' + carId);
            })
            .catch(err => {
                console.error('Error copying text: ', err);
            });
    }
</script>

</body>
</html>
