<?php
$host     = getenv('DB_HOST');
$port     = getenv('DB_PORT') ?: '5432'; // default PostgreSQL port
$dbname   = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    // Connected successfully
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
