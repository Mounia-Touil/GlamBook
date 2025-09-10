<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GlamBook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$name = $_POST['name'];
$category = $_POST['category'];
$description = $_POST['description'];
$email = $_POST['email'];
$location = $_POST['location'];
$price = $_POST['price'];
$duration = $_POST['duration'];

// Insert into services table
$sql = "INSERT INTO services (name, category, description, email, location, price, duration)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssd", $name, $category, $description, $email, $location, $price, $duration);

if ($stmt->execute()) {
    // Redirect based on selected category
    switch (strtolower($category)) {
        case 'hair':
            header("Location: hair.php");
            break;
        case 'makeup':
            header("Location: makeup.php");
            break;
        case 'spa':
            header("Location: spa.php");
            break;
        default:
        
        if ($stmt->execute()) {
            // Redirect based on selected category
            if ($category === "Hair") {
                header("Location: hair.php");
            } elseif ($category === "Makeup") {
                header("Location: makeup.php");
            } else {
                header("Location: spa.php");
            }
            exit();
        }
        
    }
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
