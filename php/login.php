<?php include 'header.php'; ?>
<?php 
session_start();

// Connect to DB
$conn = new mysqli("localhost", "root", "", "GlamBook");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emailOrUsername = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Login success — save user to session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
            header("Location: home.php");
            exit();
        } else {
            $error = "❌ Incorrect password.";
        }
    } else {
        $error = "❌ User not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - GlamBook</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
  <style>
 body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #fff0f5;
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            background-color: white;
            text-align: center;
        }
    h1 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #390328;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    input:focus {
      outline: none;
      border-color: #f5b3c2;
    }

    .forgot {
      text-align: right;
      font-size: 0.9rem;
      margin-bottom: 20px;
    }

    .forgot a {
      color: #390328;
      text-decoration: none;
      font-weight: 500;
    }

    button {
      width: 100%;
      background-color: #f5b3c2;
      color: white;
      border: none;
      padding: 14px;
      border-radius: 30px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
    }

    .signup {
      margin-top: 20px;
      font-size: 0.95rem;
    }

    .signup a {
      color: #390328;
      text-decoration: none;
      font-weight: 600;
    }

    .footer-note {
      margin-top: 60px;
      font-size: 0.8rem;
      color: #888;
      text-align: center;
    }

    .error-message {
      color: red;
      font-weight: 500;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
<div class="login-container">
<div class="login-box">
  <h1>Welcome back!</h1>

  <?php if (isset($error)) echo "<div class='error-message'>$error</div>"; ?>

  <form method="POST" action="login.php">
    <input type="email" name="email" placeholder="Email or Username" required />
    <input type="password" name="password" placeholder="Password" required />

    <div class="forgot">
      <a href="#">Forgot Password?</a>
    </div>

    <button type="submit">Log in</button>

    <div class="signup">
      Don’t have an account? <a href="register.php">Sign up</a>
    </div>
  </form>
</div>

<div class="footer-note">
  © 2025 GlamBook. All Rights Reserved.
</div>
</div>
</body>
</html>
