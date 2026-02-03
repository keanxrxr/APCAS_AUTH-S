<?php
// includes/db.php

define('DB_HOST', 'localhost');
define('DB_NAME', 'apcas_db');
define('DB_USER', 'root');           // ← CHANGE THIS
define('DB_PASS', '');               // ← CHANGE THIS
define('DB_CHARSET', 'utf8mb4');

function getDbConnection() {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        die("Database connection failed. Please try again later.");
    }
}