<?php
define('DBHOST', 'localhost');
define('DBNAME', 'dbschema_1221642');
define('DBUSER', 'root');
define('DBPASS', '');
try {
    // Directly create a PDO instance
    $pdo = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);

    // Set error mode to throw exceptions for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
