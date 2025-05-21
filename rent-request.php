<?php
require("Connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and car_id from form input
    $username = $_POST['username'];
    $car_id = $_POST['car_id'];

    // Check if the car ID and username are not empty
    if (!empty($username) && !empty($car_id)) {
        // Insert the rental request into the database
        $query = "INSERT INTO rental_requests (username, car_id, rental_status) VALUES (?, ?, 'Pending')";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $username, $car_id);

        if ($stmt->execute()) {
            echo "Your rental request has been submitted successfully.";
            // Optionally, redirect or provide feedback
        } else {
            echo "Error submitting rental request. Please try again later.";
        }
        $stmt->close();
    } else {
        echo "Username and Car ID cannot be empty.";
    }
} else {
    echo "Invalid request method.";
}

$con->close();
?>


