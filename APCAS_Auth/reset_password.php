<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>APCAS – Reset Password</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
  <h2>Create New Password</h2>

  <?php 
    $email = isset($_GET['email']) ? trim($_GET['email']) : '';
    $token = isset($_GET['token']) ? $_GET['token'] : '';
    
    $valid = false;
    if (!empty($email) && !empty($token) && isset($_SESSION['reset_tokens'][$email])) {
        if ($_SESSION['reset_tokens'][$email] === $token) {
            $valid = true;
        }
    }
    
    if (!$valid): 
  ?>
    <div class="error">Invalid or expired reset link. <a href="forgot_password.php">Request a new one</a></div>
  <?php else: ?>
    <?php if (isset($_GET['error'])): ?>
      <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
      <div class="success"><?= htmlspecialchars($_GET['success']) ?></div>
    <?php endif; ?>

    <form action="process.php" method="POST">
      <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
      <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
      
      <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" id="new_password" name="new_password" required minlength="8" placeholder="At least 8 characters">
      </div>

      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required minlength="8">
      </div>

      <button type="submit" class="btn" name="reset_password">Reset Password</button>
      <button type="button" class="btn btn-cancel" onclick="window.location='index.php'">Cancel</button>
    </form>
  <?php endif; ?>

  <div class="center">
    <a href="index.php">Back to Login</a>
  </div>
</div>

</body>
</html>
