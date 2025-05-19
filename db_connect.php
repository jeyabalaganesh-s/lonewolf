<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lonewolf";

// Enable error reporting for MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Connect to MySQL server without specifying a database
    $conn = mysqli_connect($servername, $username, $password,$dbname);
} catch (mysqli_sql_exception $e) {
    die("Database connection or creation failed: " . $e->getMessage());
} 
?>