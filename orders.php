<?php
include('userheader.php');

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

// Get user details
$email = $_SESSION['email'];

// Fetch user's orders from the database
$sql = "SELECT * FROM orders WHERE user_email = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!-- Main Content -->
<div class="container content my-5">
    <h1 class="text-center mb-4">Order History</h1>

    <?php if (!empty($orders)) { ?>
        <div class="row">
            <?php foreach ($orders as $order) { ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order #<?php echo htmlspecialchars($order['order_id']); ?></h5>
                            <p class="card-text"><strong>Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
                            <p class="card-text"><strong>Total:</strong> $<?php echo htmlspecialchars($order['total_amount']); ?></p>
                            <p class="card-text"><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
                            <a href="order_details.php?order_id=<?php echo htmlspecialchars($order['order_id']); ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="alert alert-warning text-center" role="alert">
            You have no orders yet. <a href="products.php" class="alert-link">Start shopping now!</a>
        </div>
    <?php } ?>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Lone Wolf. All Rights Reserved.</p>
    <a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
