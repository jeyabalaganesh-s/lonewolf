<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lone Wolf</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<header class="p-3 bg-dark text-white">
    <div class="container d-flex justify-content-between align-items-center">
        <h1><a href="./index.php">Lone Wolf</a></h1>
        <nav class="d-flex align-items-center">
            <a href="./index.php" class="text-white text-decoration-none me-3">Home</a>
            <a href="./shop.php" class="text-white text-decoration-none me-3">Shop</a>
            <a href="./aboutus.php" class="text-white text-decoration-none me-3">About us</a>
            <a href="./contact.php" class="text-white text-decoration-none me-3">Contact</a>

            <?php if (isset($_SESSION['user'])): ?>
                <!-- Show Logout if user is logged in -->
                <a href="./logout.php" class="btn btn-outline-light">Logout</a>
            <?php else: ?>
                <!-- Show Login if user is not logged in -->
                <a href="./login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
