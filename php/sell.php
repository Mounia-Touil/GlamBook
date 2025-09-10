<?php include 'header.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $category = htmlspecialchars($_POST['category']);
    $description = htmlspecialchars($_POST['description']);
    $email = htmlspecialchars($_POST['email']);
    $location = htmlspecialchars($_POST['location']);
    $price = htmlspecialchars($_POST['price']);
    $duration = htmlspecialchars($_POST['duration']);

    // Example: Save data to a database (requires database connection setup)
    $conn = new mysqli('localhost', 'root', '', 'glambook');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("INSERT INTO services (name, category, description, email, location, price, duration) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $category, $description, $email, $location, $price, $duration);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // For now, display a success message
    echo "<script>alert('Service submitted successfully!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sell Your Service - GlamBook</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../styles/style.css"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #fff0f5;
      margin: 0;
    }

    .container {
      max-width: 700px;
      margin: 60px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #b3002d;
    }

    label {
      font-weight: 500;
      margin-top: 20px;
      display: block;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-top: 5px;
    }

    button {
      background-color: #b3002d;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 25px;
      cursor: pointer;
      margin-top: 25px;
      font-size: 1rem;
      display: block;
      width: 100%;
    }

    button:hover {
      background-color: #8e0025;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>List Your Beauty Service</h2>
    <form method="POST" action="sell.php" style="margin-top: 30px;">
      <label>Your Name or Business Name</label>
      <input type="text" name="name" placeholder="Your Name or Business Name" required>

      <label>Service Category</label>
      <select name="category" required style="
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-top: 5px;
      font-size: 1rem;
      background: white;
    ">
      <option value="" disabled selected>Select a category</option>
      <option value="Hair">Hair</option>
      <option value="Makeup">Makeup</option>
      <option value="Spa">Spa</option>
    </select>

      <label>Service Description</label>
      <textarea name="description" rows="4" placeholder="Describe your service..." required></textarea>

      <label>Contact Email</label>
      <input type="email" name="email" placeholder="you@example.com" required>

      <label>Location</label>
      <input type="text" name="location" placeholder="City or Zip Code" required>

      <label>Service Price ($)</label>
      <input type="number" name="price" step="0.01" placeholder="e.g., 50" required>

      <label>Estimated Duration (minutes)</label>
      <input type="text" name="duration" placeholder="e.g., 45" required>

      <button type="submit">Submit Service</button>
    </form>
  </div>
</body>
</html>