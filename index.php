<?php 
include('header.php'); 
include('db_connect.php'); // Include database connection
?>

<!-- Hero Section -->
<header class="hero-section text-white text-center">
    <div class="container">
        <font color="black"><h1 class="display-4">Discover the Latest Trends</h1>
        <p class="lead">Elevate your wardrobe with Lone Wolf's newest collection.</p></font>
        <a href="shop.php" class="btn btn-primary">Shop Now</a>
    </div>
</header>

<!-- Posters Section -->
<section class="posters py-5">
    <div class="container">
   
        <h2 class="text-white text-center mb-4"><font color="black">Explore Our Collections</font></h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="poster">
                    <img src="./poster/page1.jpg" class="img-fluid rounded" alt="Poster 1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="poster">
                    <img src="./poster/page1.jpg" class="img-fluid rounded" alt="Poster 2">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- New Clothes Section -->
<section class="new-clothes py-5">
    <div class="container">
        <h2 class="text-white text-center mb-4"><font color="black">New Arrivals</font></h2>
        <div class="row g-4">
            <?php
            // Fetch data from the database
            $query = "SELECT * FROM products";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-md-3">
                        <div class="card bg-dark text-white">
                            <img src="./product/<?php echo $row['image_url']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-white text-center'>No new arrivals available.</p>";
            }
            ?>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
