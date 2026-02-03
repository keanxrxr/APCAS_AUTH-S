<?php
// Email configuration for Gmail SMTP
function send_email(string $to, string $subject, string $html_body, string $plain_body = ''): bool {
    // Gmail SMTP credentials - Replace with your Gmail address and App Password
    $gmail_address = 'your-email@gmail.com';      // ← Change this to your Gmail
    $gmail_password = 'your-app-password';         // ← Change this to your App Password
    
    if (empty($plain_body)) {
        $plain_body = strip_tags($html_body);
    }

    // Email headers
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: APCAS <" . $gmail_address . ">\r\n";
    $headers .= "Reply-To: " . $gmail_address . "\r\n";

    // Using PHP mail() with Gmail SMTP (requires proper PHP/system config)
    // For production, use this function with proper SMTP setup
    
    // For now, use a simple alternative - file logging
    // This logs registration emails for testing purposes
    $log_file = __DIR__ . '/emails.log';
    $log_entry = "[" . date('Y-m-d H:i:s') . "] TO: $to | SUBJECT: $subject | MESSAGE: $html_body\n";
    file_put_contents($log_file, $log_entry, FILE_APPEND);
    
    return true;
}
?>
