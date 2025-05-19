<?php
// Include the database connection
include 'userheader.php';

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

// Get user details
$email = $_SESSION['email'];

// Fetch user data from the database
$sql = "SELECT * FROM customer WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch user stats: Total Orders
$sql_orders = "SELECT COUNT(*) AS order_count FROM orders WHERE user_email = ?";
$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->bind_param("s", $email);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();
$order_stats = $result_orders->fetch_assoc();
$stmt_orders->close();
?>


<!-- Main Content -->
<div class="container my-5">
    <h1 class="text-center mb-4">View Profile</h1>
    <div class="row">
        <!-- Profile Picture and User Information -->
        <div class="col-md-4 text-center">
        <img src="<?php echo !empty($user['profile_picture']) ? 'uploads/'.$user['profile_picture'] : 'images/default-profile.png'; ?>" alt="Current Profile Picture" class="profile-picture mt-3" style="max-width: 150px; max-height: 150px; border-radius: 50%; object-fit: cover;">
            <h2 class="mt-3"><?php echo htmlspecialchars($user['name']); ?></h2>
            <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
            <a href="edit_profile.php" class="btn btn-warning">Edit Profile</a>
        </div>

        <!-- User Stats -->
        <div class="col-md-8">
            <div class="card stats-card mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">User Status</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <h6>Total Orders</h6>
                            <p class="display-4"><?php echo $order_stats['order_count']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Last Login</h6>
                            <p><?php echo date("Y-m-d H:i:s"); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Account Created</h6>
                            <p><?php echo htmlspecialchars($user['created_at']); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order History -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order History</h5>
                    <p>View and manage your past orders.</p>
                    <a href="orders.php" class="btn btn-success">View Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->


<?php
include 'userfooter.php';
?>
