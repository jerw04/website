<?php
// Connect to the database
include 'Connection.php';

// Fetch all feedback records
$query = "SELECT * FROM feedback";
$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error fetching data: " . mysqli_error($con);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Feedbacks</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Lobster&display=swap" rel="stylesheet"> <!-- Include fonts -->
    <style>
        /* Updated Gothic and High UI/UX Style */
        body {
            margin: 0;
            font-family: 'Lora', serif; /* Gothic serif font */
            background-color: #111; /* Dark background for a gothic feel */
            color: #e0e0e0; /* Light text color for contrast */
            padding-top: 60px;
        }

        /* HEADER */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            background: linear-gradient(135deg, #000000, #737070); /* Deep black gradient */
            padding: 10px 0;
            z-index: 1000;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.8); /* Dark shadow for depth */
            display: flex;
            justify-content: space-between; /* Spaces out logo and nav */
            align-items: center; /* Aligns vertically in the middle */
        }

        .Navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 96%;
            margin: auto;
        }

        .logo-img-new img {
            height: 3.5em;
            filter: grayscale(100%); /* Gothic monochrome effect */
        }

        /* NAVBAR */
        nav {
            display: flex;
            gap: 15px;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }

        nav a {
            color: #e0e0e0;
            font-size: 1.2em;
            font-weight: 500;
            text-decoration: none;
            padding: 12px 16px;
            transition: color 0.3s ease, border-bottom 0.3s ease;
        }

        nav a:hover {
            color: #d4af37; /* Gold gothic highlight color */
            border-bottom: 2px solid #d4af37;
        }

        /* TABLE STYLING */
        table {
            width: 100%;
            margin-top: 80px; /* Offset for the fixed header */
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .rating {
            color: #FFD700;
        }

        .container {
            padding: 4em 2em;
            background-color: #1c1c1c;
            text-align: center;
            color: #ccc;
            font-size: 1.2em;
        }

        .title-text {
            font-size: 3.5em;
            color: #d4af37;
            font-family: 'Lora', serif;
            background-color: transparent;
            text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.7);
        }

        .footer {
            background-color: #111;
            color: #ccc;
            text-align: center;
            padding: 30px 0;
            border-top: 2px solid #333;
        }

        .footer-content p {
            font-size: 1.1em;
            color: #e0e0e0;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .footer-links li {
            display: inline;
        }

        .footer a {
            color: #d4af37;
            font-size: 1em;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #b8860b;
        }
    </style>
</head>
<body>

    <div class="header">
        <!-- Insert your logo and navbar here -->
    </div>

    <div class="container">
        <h2 class="title-text">Feedbacks Submitted</h2>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Service Type</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the results and display them
                while ($row = mysqli_fetch_assoc($result)) {
                    $rating = str_repeat('&#9733;', $row['rating']); // Display stars for rating
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['message']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['service_type']}</td>
                            <td><span class='rating'>{$rating}</span></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="footer-content">
            <p>Thank you for visiting!</p>
        </div>
    </div>

</body>
</html>

<?php
// Close the connection
mysqli_close($con);
?>
