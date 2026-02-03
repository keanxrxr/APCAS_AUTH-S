<?php
session_start();
require 'email.php';

// Simulate a user storage (in a real app, use a database)
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        // Basic validation
        if (empty($email) || empty($password) || empty($password2)) {
            header("Location: register.php?error=All fields are required");
            exit;
        }
        if ($password !== $password2) {
            header("Location: register.php?error=Passwords do not match");
            exit;
        }
        if (isset($_SESSION['users'][$email])) {
            header("Location: register.php?error=Email already registered");
            exit;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Store user (in session for demo)
        $_SESSION['users'][$email] = [
            'password' => $hashed_password
        ];

        // Send welcome email
        $subject = "Welcome to APCAS - Registration Successful";
        $html_body = "
        <h2>Welcome to APCAS!</h2>
        <p>Thank you for registering with us.</p>
        <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
        <p>You can now log in with your credentials.</p>
        <p><a href='http://localhost/School/index.php'>Click here to login</a></p>
        <p>Best regards,<br>APCAS Team</p>
        ";
        
        send_email($email, $subject, $html_body);

        header("Location: index.php?success=Registration successful! Check your email for confirmation.");
        exit;
    } elseif (isset($_POST['login'])) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // Check if user exists
        if (!isset($_SESSION['users'][$email])) {
            header("Location: index.php?error=Invalid email or password");
            exit;
        }

        $user = $_SESSION['users'][$email];

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $email;
            $_SESSION['user_email'] = $email;
            header("Location: dashboard.php");
            exit;
        } else {
            header("Location: index.php?error=Invalid email or password");
            exit;
        }
    } elseif (isset($_POST['forgot_password'])) {
        $email = trim($_POST['email']);

        // Check if user exists
        if (!isset($_SESSION['users'][$email])) {
            header("Location: forgot_password.php?error=Email not found in our system");
            exit;
        }

        // Generate a reset token (in production, save this to database with expiration)
        $reset_token = bin2hex(random_bytes(32));
        $_SESSION['reset_tokens'][$email] = $reset_token;

        // Send password reset email
        $subject = "APCAS - Password Reset Request";
        $html_body = "
        <h2>Password Reset Request</h2>
        <p>We received a request to reset your password.</p>
        <p><a href='http://localhost/School/reset_password.php?email=" . urlencode($email) . "&token=" . $reset_token . "'>Click here to reset your password</a></p>
        <p>If you didn't request this, you can ignore this email.</p>
        <p>Best regards,<br>APCAS Team</p>
        ";
        
        send_email($email, $subject, $html_body);

        header("Location: forgot_password.php?success=Reset link sent to your email!");
        exit;
    } elseif (isset($_POST['reset_password'])) {
        $email = trim($_POST['email']);
        $token = $_POST['token'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Verify token
        if (!isset($_SESSION['reset_tokens'][$email]) || $_SESSION['reset_tokens'][$email] !== $token) {
            header("Location: forgot_password.php?error=Invalid reset link");
            exit;
        }

        // Validate passwords
        if (empty($new_password) || empty($confirm_password)) {
            header("Location: reset_password.php?email=" . urlencode($email) . "&token=" . $token . "&error=All fields are required");
            exit;
        }

        if ($new_password !== $confirm_password) {
            header("Location: reset_password.php?email=" . urlencode($email) . "&token=" . $token . "&error=Passwords do not match");
            exit;
        }

        // Check if user exists
        if (!isset($_SESSION['users'][$email])) {
            header("Location: forgot_password.php?error=User not found");
            exit;
        }

        // Update password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $_SESSION['users'][$email]['password'] = $hashed_password;
        
        // Clear the reset token
        unset($_SESSION['reset_tokens'][$email]);

        // Send confirmation email
        $subject = "APCAS - Password Changed Successfully";
        $html_body = "
        <h2>Password Changed</h2>
        <p>Your password has been successfully reset.</p>
        <p>You can now log in with your new password.</p>
        <p><a href='http://localhost/School/index.php'>Click here to login</a></p>
        <p>Best regards,<br>APCAS Team</p>
        ";
        
        send_email($email, $subject, $html_body);

        header("Location: index.php?success=Password reset successful! You can now login.");
        exit;
    }
}
?>