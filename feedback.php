

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="style.css">
    <style> 
    body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f5f5f5;
}

.feedback-container {
    width: 400px;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

label {
    display: block;
    margin-top: 10px;
    color: #555;
}

input, select, textarea {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.star-rating {
    display: flex;
    direction: rtl; 
    justify-content: space-between;
}

.star-rating input {
    display: none; 
}

.star-rating label {
    font-size: 25px;
    color: #ddd; 
    cursor: pointer;
    transition: color 0.2s ease-in-out;
}


.star-rating input:checked ~ label {
    color: #FFD700; 
}


.star-rating label:hover ~ label {
    color: #FFD700;
}



button {
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    border: none;
    border-radius: 4px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
    <div class="feedback-container">
        <h2>Provide Your Feedback</h2>
        <form action="submit_feedback.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="car_id_feedback">Car ID:</label>
            <input type="text" id="car_id_feedback" name="car_id_feedback" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="service_type">Service Type:</label>
            <select id="service_type" name="service_type" required>
                <option value="Rent Someone's Car">Rent Someone's Car</option>
                <option value="Rent Your Car">Rent Your Car</option>
            </select>

            <label for="rating">Rating:</label>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars">★</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars">★</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars">★</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars">★</label>
                <input type="radio" id="star1" name="rating" value="1" ><label for="star1" title="1 star">★</label>
            </div>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
