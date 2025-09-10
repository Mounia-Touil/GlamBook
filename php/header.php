<?php
session_start();
$current_page = strtolower(pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_FILENAME));
$bodyClass = $bodyClass ?? '';

// Navigation links
$nav_items = [
    'logged_out' => [
        ['href' => '../how-it-works.html', 'text' => 'How It Works'],
        ['href' => 'login.php', 'text' => 'Login'],
        ['href' => 'register.php', 'text' => 'Get Started', 'class' => 'hero-btn']
    ],
    'logged_in' => [
        'home' => [
            ['href' => 'home.php', 'text' => 'Home'],
            ['href' => 'profile.php', 'text' => 'My Profile'],
            ['href' => 'sell.php', 'text' => 'Sell Your Service']
        ],
        'sell' => [
            ['href' => 'home.php', 'text' => 'Home'],
            ['href' => 'profile.php', 'text' => 'My Profile']
        ],
        'profile' => [
            ['href' => 'home.php', 'text' => 'Home'],
            ['href' => 'sell.php', 'text' => 'Sell Your Service']
        ],
        'default' => [
            ['href' => 'home.php', 'text' => 'Home'],
            ['href' => 'profile.php', 'text' => 'My Profile'],
            ['href' => 'sell.php', 'text' => 'Sell Your Service']
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= ucfirst($current_page) ?> - GlamBook</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;500;700&display=swap">
  <link rel="stylesheet" href="../styles/styles.css">
</head>
<body class="<?= $bodyClass ?>">
  <?php if ($bodyClass === 'index-page'): ?>
    <div class="overlay"></div>
  <?php endif; ?>

  <header class="navbar">
    <a href="<?= isset($_SESSION['user']) ? 'home.php' : 'index.php'; ?>" class="logo">GlamBook</a>
    <nav class="nav-links">
      <?php if (!isset($_SESSION['user'])): ?>
        <?php foreach ($nav_items['logged_out'] as $item): ?>
          <a href="<?= $item['href']; ?>" <?= isset($item['class']) ? 'class="' . $item['class'] . '"' : '' ?>>
            <?= $item['text']; ?>
          </a>
        <?php endforeach; ?>
      <?php else: ?>
        <?php
          $current_nav = $nav_items['logged_in'][$current_page] ?? $nav_items['logged_in']['default'];
          foreach ($current_nav as $item):
        ?>
          <a href="<?= $item['href']; ?>" <?= isset($item['class']) ? 'class="' . $item['class'] . '"' : '' ?>>
            <?= $item['text']; ?>
          </a>
        <?php endforeach; ?>
        <a href="logout.php">Logout</a>
      <?php endif; ?>
    </nav>
  </header>
