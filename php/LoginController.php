<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}
?>
<?php
session_start();
include '../models/Database.php';
include '../models/User.php';

$db = new mysqli('localhost', 'root', '', 'GlamBook');
$userModel = new User($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $user = $userModel->login($email, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        header("Location: home.html");
        exit();
    } else {
        echo "Invalid login!";
    }
}
?>
