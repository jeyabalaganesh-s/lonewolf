<?php
session_start();
include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $password;
    
    // Protect against SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to verify admin credentials
    $query = "SELECT * FROM admin_users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) 
    {
        $admin = mysqli_fetch_assoc($result);
        echo $admin['password'];
    
        // Verify the password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];

            // Redirect to the admin dashboard
            header("Location: admin_dashboard.php");
            exit;
        } else {
            echo "<script>alert('Invalid password!'); 
            //window.location='admin_login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid username!'); 
        //window.location='admin_login.php';</script>";
    }
} else {
    header("Location: admin_login.php");
    exit;
}
?>
