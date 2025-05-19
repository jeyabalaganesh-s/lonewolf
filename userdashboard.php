<?php
include('userheader.php');
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
?>
<!-- Main Content -->
<div class="container my-5">
    <h1 class="text-center mb-4">Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
    <div class="row">
        <!-- User Information Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Your Information</h5>
                    <p class="card-text">Email: <?php echo htmlspecialchars($user['email']); ?></p>
                    <p class="card-text">Account Created: <?php echo htmlspecialchars($user['created_at']); ?></p>
                </div>
            </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Recent Activity</h5>
                    <ul class="list-unstyled">
                        <li>Logged in at <?php echo date("Y-m-d H:i:s"); ?></li>
                        <li>Last Order: 2025-01-12</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recommendations Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Recommendations</h5>
                    <p class="card-text">Check out our latest winter collection!</p>
                    <a href="products.php" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Sections -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order History</h5>
                    <p>View and manage your past orders.</p>
                    <a href="orders.php" class="btn btn-success">View Orders</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Buy Products</h5>
                    <p>Explore and purchase products from our collection.</p>
                    <a href="products.php" class="btn btn-warning">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center">
    <p>&copy; 2025 Lone Wolf. All Rights Reserved.</p>
    <a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
