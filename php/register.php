<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to DB
    $conn = new mysqli("localhost", "root", "", "GlamBook");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get sanitized POST data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $dob = $_POST['dob'];
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash password

    // Insert query
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, dob, username, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $dob, $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php"); // redirect to login after successful signup
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Get Started - GlamBook</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../styles/register.css" />
</head>

<body>
  <div class="header">GlamBook</div>

  <div class="left">
    <h1>Create Your Glam Profile</h1>
    <p>Sign up and start booking or managing beauty services — it’s fast, free, and fabulous.</p>
    <form method="POST" action="">
      <input type="text" name="name" placeholder="Full Name" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="text" name="phone" placeholder="Phone Number" required />
      <input type="date" name="dob" placeholder="Date of Birth" required />
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Sign Up</button>
    </form>
  </div>

  <div class="right">
    <div class="feature">
      <h2>Why GlamBook?</h2>
      <p>
        ✨ Book hair, makeup, nails, and spa services in seconds.<br/><br/>
        💖 Salon owners can easily create a service list and manage all appointments.<br/><br/>
        📅 Stay organized with smart scheduling and automatic reminders.<br/><br/>
        🌍 Built to connect glam seekers and glam creators — beautifully.
      </p>
    </div>
  </div>
</body>
</html>
