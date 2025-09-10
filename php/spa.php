<?php include 'header.php';

$conn = new mysqli("localhost", "root", "", "GlamBook");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT * FROM services WHERE category = 'Spa'";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Spa Services - GlamBook</title>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
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
    }

    .card p {
      color: #444;
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
    <h1>Spa & Relaxation</h1>
    <p>Rewind, relax, and recharge with luxurious spa treatments. Indulge in massages, facials, aromatherapy, and more from top-rated wellness professionals. Escape the stress and treat yourself to a peaceful experience your body and mind will thank you for.</p>
  </section>

  <div class="card-container">
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="card">
      <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p><strong></strong> <?= htmlspecialchars($row['description']) ?></p>
        <p><strong>Duration:</strong> <?= (int)$row['duration'] ?> mins</p>
        <p><strong>Price:</strong> $<?= number_format($row['price'], 2) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>


        <!-- Booking form -->
        <form method="POST" action="BookingController.php">
          <input type="hidden" name="name" value="<?= htmlspecialchars($row['name']) ?>">
          <input type="hidden" name="category" value="<?= htmlspecialchars($row['category']) ?>">
          <input type="hidden" name="location" value="<?= htmlspecialchars($row['location']) ?>">
          <input type="hidden" name="phone" value="0000000000">
          <input type="hidden" name="email" value="client@example.com">
          <input type="hidden" name="booking_time" value="<?= date('H:i:s') ?>">
          <input type="hidden" name="description" value="<?= htmlspecialchars($row['description']) ?>">
          <button type="submit" class="btn">Book Now</button>
        </form>

      </div>
    <?php endwhile; ?>
  </div>

</body>
</html>
