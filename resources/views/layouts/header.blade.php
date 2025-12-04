<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Detect current page to hide navbar on login/register pages
$current_page = basename($_SERVER['PHP_SELF']);
$auth_pages = ['login.php', 'register.php']; // pages without navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CampusConnect</title>
  <link rel="stylesheet" href="/CampusConnect/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/CampusConnect/assets/css/style.css">
</head>
<body class="bg-light">

<?php if (!in_array($current_page, $auth_pages) && isset($_SESSION['user'])): ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/CampusConnect/index.php">🏫 CampusConnect</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/CampusConnect/modules/notes/view.php">📘 Notes</a></li>
          <li class="nav-item"><a class="nav-link" href="/CampusConnect/modules/chat/">💬 Chat Room</a></li>
          <li class="nav-item"><a class="nav-link" href="/CampusConnect/modules/rent/">🏠 Rent</a></li>
          <li class="nav-item"><a class="nav-link" href="/CampusConnect/modules/food/">🍔 Food</a></li>
          <li class="nav-item">
            <span class="nav-link">👋 Hello, <?= htmlspecialchars(explode(' ', $_SESSION['user']['name'])[0]); ?>!</span>
          </li>
          <li class="nav-item">
            <a href="/CampusConnect/modules/auth/logout.php" class="btn btn-outline-light btn-sm ms-2">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<?php endif; ?>

<div class="container mt-4">