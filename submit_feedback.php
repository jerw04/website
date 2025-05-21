<?php
// Connect to the database
include 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $car_id_feedback = $_POST['car_id_feedback'];
    $message = $_POST['message'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $service_type = $_POST['service_type'];
    $rating = $_POST['rating'];
    $service_type = str_replace("'", "\'", $service_type);

    // Insert data into the feedback table
    $query = "INSERT INTO feedback (name, car_id_feedback, message, email, phone, service_type, rating) 
              VALUES ('$name', '$car_id_feedback', '$message', '$email', '$phone', '$service_type', '$rating')";

    if (mysqli_query($con, $query)) {
        // Show a styled prompt box instead of an alert
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = document.createElement('div');
                    modal.style.position = 'fixed';
                    modal.style.top = '50%';
                    modal.style.left = '50%';
                    modal.style.transform = 'translate(-50%, -50%)';
                    modal.style.backgroundColor = '#4CAF50';
                    modal.style.color = 'white';
                    modal.style.padding = '20px 40px';
                    modal.style.borderRadius = '10px';
                    modal.style.fontSize = '18px';
                    modal.style.textAlign = 'center';
                    modal.style.boxShadow = '0px 4px 10px rgba(0, 0, 0, 0.3)';
                    modal.style.zIndex = '1000';
                    modal.innerHTML = 'Thank you for your feedback!';

                    var closeButton = document.createElement('button');
                    closeButton.textContent = 'Close';
                    closeButton.style.marginTop = '20px';
                    closeButton.style.padding = '10px 20px';
                    closeButton.style.border = 'none';
                    closeButton.style.backgroundColor = '#ff4d4d';
                    closeButton.style.color = 'white';
                    closeButton.style.fontSize = '16px';
                    closeButton.style.borderRadius = '5px';
                    closeButton.style.cursor = 'pointer';
                    closeButton.onclick = function() {
                        modal.style.display = 'none'; // Hide the modal
                        window.location.href = 'index.'; // Redirect to home page
                    };

                    modal.appendChild(closeButton);

                    document.body.appendChild(modal);
                });
              </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
