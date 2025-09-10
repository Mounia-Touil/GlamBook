<?php
include 'header.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Profile - GlamBook</title>
  <link rel="stylesheet" href="../styles/profile.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
</head>
<body>

<div class="profile-container">
  <div class="profile-header">
    <h2>Hello, <?php echo htmlspecialchars($user['name']); ?>!</h2>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
  </div>

  <div class="profile-grid">
    <!-- Personal Info -->
    <div class="profile-card">
      <h3>Personal Information</h3>
      <form>
        <label>Full Name</label>
        <input type="text" value="<?php echo htmlspecialchars($user['name']); ?>" />
        <label>Phone Number</label>
        <input type="text" placeholder="Enter phone" />
        <button class="btn-teal">Save Changes</button>
      </form>
    </div>

    <!-- Security -->
    <div class="profile-card">
      <h3>Security</h3>
      <form>
        <label>Current Password</label>
        <input type="password" />
        <label>New Password</label>
        <input type="password" />
        <label>Confirm New Password</label>
        <input type="password" />
        <button class="btn-teal">Update Password</button>
      </form>
    </div>

    <!-- Profile Picture -->
    <div class="profile-card text-center">
      <h3>Profile Picture</h3>
      <img src="default.png" alt="Profile Picture" class="profile-pic mb-2" />
      <input type="file" />
      <button class="btn-teal">Upload Picture</button>
    </div>

    <!-- Bookings -->
    <div class="profile-card">
      <h3>My Bookings</h3>
      <p><strong>Upcoming:</strong> 2 Appointments</p>
      <p><strong>Past:</strong> 5 Appointments</p>
      <button class="btn-outline-pink">View All Bookings</button>
    </div>

    <!-- Preferences -->
    <div class="profile-card">
      <h3>Beauty Preferences</h3>
      <label class="checkbox-label"><input type="checkbox" checked> Hair Services</label>
      <label class="checkbox-label"><input type="checkbox"> Makeup</label>
      <label class="checkbox-label"><input type="checkbox"> Spa & Relaxation</label>
    </div>

    <!-- Notifications -->
    <div class="profile-card">
      <h3>Notification Settings</h3>
      <label class="checkbox-label"><input type="checkbox" checked> Email reminders</label>
      <label class="checkbox-label"><input type="checkbox"> Text message alerts</label>
      <label class="checkbox-label"><input type="checkbox"> Promotional offers</label>
    </div>
  </div>
</div>

</body>
</html>
