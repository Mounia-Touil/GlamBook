<?php include 'header.php'; ?>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "GlamBook");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT * FROM services WHERE category = 'Hair'";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hair Services - GlamBook</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff0f5;
      margin: 0;
    }

    .section-title {
      
      padding: 40px 20px;
      text-align: center;
    }

    .section-title h1 {
      color: #2c2c54;
      font-size: 2rem;
      margin-bottom: 10px;
    }

    .section-title p {
      color: #555;
      font-size: 1rem;
    }

    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 30px;
    }

    .card {
      background: white;
      border-radius: 16px;
      padding: 20px;
      margin: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
    }

    .card h3 {
      color: #b30059;
      margin-bottom: 10px;
    }

    .card p {
      color: #444;
      margin: 4px 0;
    }

    .btn {
      background-color: #ff80aa;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: #e60073;
    }
  </style>
</head>
<body>
  <section class="section-title">
    <h1>Hair Styling & Care</h1>
    <p>Discover your perfect look with expert hairstylists! Whether you're after a sleek blowout, vibrant color, trendy haircut, or special event updo, our pros deliver flawless results using top-quality products. Book now for a confidence-boosting transformation!</p>
  </section>

  <div class="card-container">
  <?php while($row = $result->fetch_assoc()): ?>
    <form action="BookingController.php" method="POST">
      <div class="card">
        <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p><strong></strong> <?= htmlspecialchars($row['description']) ?></p>
        <p><strong>Duration:</strong> <?= (int)$row['duration'] ?> mins</p>
        <p><strong>Price:</strong> $<?= number_format($row['price'], 2) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>

        <!-- Hidden fields to pass to controller -->
        <input type="hidden" name="name" value="<?= htmlspecialchars($row['name']) ?>">
        <input type="hidden" name="category" value="<?= htmlspecialchars($row['category']) ?>">
        <input type="hidden" name="description" value="<?= htmlspecialchars($row['description']) ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($row['email']) ?>">
        <input type="hidden" name="location" value="<?= htmlspecialchars($row['location']) ?>">
        <input type="hidden" name="price" value="<?= htmlspecialchars($row['price']) ?>">
        <input type="hidden" name="duration" value="<?= htmlspecialchars($row['duration']) ?>">

        <form method="POST" action="BookingController.php">
    <input type="hidden" name="service_id" value="<?= $row['id'] ?>">
    <button type="submit" class="btn">Book Now</button>
</form>

      </div>
    </form>
  <?php endwhile; ?>
</div>


</body>
</html>
