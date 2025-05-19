<?php
session_start();

// Database connection
$host = 'localhost'; // Change if needed
$dbname = 'lonewolf'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Login logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    if (!empty($inputUsername) && !empty($inputPassword)) {
        // Prepare SQL query
        $stmt = $pdo->prepare("SELECT * FROM customer WHERE id = :username");
        $stmt->bindParam(':username', $inputUsername);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($inputPassword, $user['password'])) {
            // Store username in session and redirect
            $_SESSION['username'] = $user['username'];
            header("Location: user_home.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Please fill in all fields!";
    }
}