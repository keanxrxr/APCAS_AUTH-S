<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>APCAS – Forgot Password</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
  <h2>Reset Password</h2>

  <?php if (isset($_GET['error'])): ?>
    <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
  <?php endif; ?>

  <?php if (isset($_GET['success'])): ?>
    <div class="success"><?= htmlspecialchars($_GET['success']) ?></div>
  <?php endif; ?>

  <form action="process.php" method="POST">
    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required placeholder="you@example.com">
    </div>

    <button type="submit" class="btn" name="forgot_password">Send Reset Link</button>
    <button type="button" class="btn btn-cancel" onclick="window.location='index.php'">Cancel</button>
  </form>

  <div class="center">
    Remember your password? <a href="index.php">Login</a>
  </div>
</div>

</body>
</html>
