<?php
// Include the database connection
include 'db_connect.php';

// Start a session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the login form
    $username = $_POST['email'];
    $password = $_POST['password'];
    // Prepare a parameterized query to avoid SQL injection
    $sql = "SELECT * FROM customer WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // 's' means the email is a string
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $user = $result->fetch_assoc();
  
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Regenerate session ID to prevent session fixation
            session_regenerate_id();

            // Set session variables
            $_SESSION['email'] = $user['email'];
            $_SESSION['logged_in'] = true;
                
            // Redirect to the dashboard or home page
            header("Location: userdashboard.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that email!";
    }
    
    // Close statement
    $stmt->close();
}

?>