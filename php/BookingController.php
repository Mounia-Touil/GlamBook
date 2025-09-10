<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment - GlamBook</title>
    <link rel="stylesheet" href="../style.css">
    <style>
         body {
      font-family: 'Poppins', sans-serif;
      background: #fff0f5;
      margin: 0;
    }
        .booking-form {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .booking-form h2 {
            text-align: center;
            color: #b30059;
            margin-bottom: 20px;
        }
        .booking-form input, .booking-form select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .booking-form button {
            width: 100%;
            background-color: #ff80aa;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
        }
        .booking-form button:hover {
            background-color: #e60073;
        }
    </style>
</head>

<body>
<div class="booking-form">
    <h2>Book Your Appointment</h2>
    <form method="POST" action="BookingController.php">
        <label for="name">Your Name</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" required>

        <label for="phone">Phone Number</label>
        <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>

        <label for="category">Category</label>
        <select name="category" id="category">
            <option value="Hair">Hair</option>
            <option value="Makeup">Makeup</option>
            <option value="Spa">Spa</option>
        </select>

        <label for="salon">Salon/Spa Name</label>
        <input type="text" name="location" id="salon" placeholder="Enter salon or spa name" required>

        <label for="booking_time">Preferred Time</label>
        <input type="time" name="booking_time" id="booking_time" required>

        <label for="description">Specific Request</label>
        <input type="text" name="description" id="description" placeholder="Haircut, facial, etc." required>

        <button type="submit">Confirm Booking</button>
    </form>
</div>
</body>
</html>


