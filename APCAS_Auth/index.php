<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>APCAS – Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
  <img src="https://apcasconnect.site/wp-content/uploads/2024/11/logow.webp" alt="APCAS logo" class="logo-top">
  <h2>Welcome to APCAS</h2>

  <?php if (isset($_SESSION['user_id'])): ?>
    <div class="success">
      Logged in as: <strong><?= htmlspecialchars($_SESSION['user_email']) ?></strong><br>
      <a href="logout.php" style="color:#ff5555;">Logout</a>
    </div>
  <?php endif; ?>

  <?php if (isset($_GET['error'])): ?>
    <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
  <?php endif; ?>

  <?php if (isset($_GET['success'])): ?>
    <div class="success"><?= htmlspecialchars($_GET['success']) ?></div>
  <?php endif; ?>

  <form action="process.php" method="POST">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required placeholder="you@example.com">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>

    <button type="submit" class="btn" name="login">Login</button>
  </form>

  <div class="center">
    <a href="register.php">Sign Up</a> • 
    <a href="forgot_password.php">Forgot Password?</a>
  </div>
</div>

</body>
</html>