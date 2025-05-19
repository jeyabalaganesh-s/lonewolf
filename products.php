<?php

include('userheader.php');
// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<!-- Main Content -->
<div class="container content my-5">
    <h1 class="text-center mb-4">Our Products</h1>

    <div class="row">
        <?php if (!empty($products)) { ?>
            <?php foreach ($products as $product) { ?>
                <div class="col-md-4">
                    <div class="card product-card">
                        <img src="./product/<?php echo htmlspecialchars($product['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="card-text"><strong>Price:</strong> <?php echo htmlspecialchars($product['price']); ?></p>
                            <a href="add_to_cart.php?product_id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="alert alert-warning text-center" role="alert">
                No products available at the moment. Please check back later.
            </div>
        <?php } ?>
    </div>
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

<?php
// Close the database connection
$conn->close();
?>
