<?php 
include('header.php'); 
include('db_connect.php'); // Include database connection
?>
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Shop</h2>
        <!-- Search Form -->
        <form method="GET" class="d-flex">
            <input 
                type="text" 
                name="search" 
                class="form-control w-25" 
                placeholder="Search products..." 
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
            >
            <button type="submit" class="btn btn-primary ms-2">Search</button>
        </form>
    </div>
    <div class="row g-4">
        <?php
        // Initialize the query
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT * FROM products WHERE name LIKE '%$search%' LIMIT 12"; // Adjust limit as needed
        $result = mysqli_query($conn, $query);

        // Check if products exist
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <!-- Dynamic Product Card -->
                <div class="col-md-3">
                    <div class="product-card p-3 text-center bg-light rounded">
                        <img 
                            src="./product/<?php echo $row['image_url']; ?>" 
                            alt="<?php echo $row['name']; ?>" 
                            class="img-fluid mb-3"
                        >
                        <h5><?php echo $row['name']; ?></h5>
                        <p class="text-muted"><?php echo number_format($row['price'], 2); ?></p>
                        <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center text-muted'>No products found.</p>";
        }
        ?>
    </div>
    <div class="mt-4">
        <!-- Pagination (Static example; dynamic implementation requires additional logic) -->
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>
<?php include('footer.php'); ?>
