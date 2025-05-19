<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lone Wolf - Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="bg-dark text-white">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <!-- Attractive Back to Home Button -->
        <div class="position-absolute top-0 start-0 m-3">
            <a href="index.php" class="btn btn-home">Back to Home</a>
        </div>

        <div id="authSlider" class="carousel slide w-50" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Login Form -->
                <div class="carousel-item active">
                    <div class="card p-4">
                        <h3 class="text-center">Login</h3>
                        <form action="userlogin.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <input type="submit" class="btn btn-primary w-100" name="Submit" value="Login">
                        </form>
                        <p class="mt-3 text-center">Don't have an account? <a href="#" data-bs-target="#authSlider" data-bs-slide-to="1">Sign Up</a></p>
                        <p class="text-center">Are you an admin? <a href="#" data-bs-target="#authSlider" data-bs-slide-to="2">Admin Login</a></p>
                    </div>
                </div>
                
                <!-- Signup Form -->
                <div class="carousel-item">
                    <div class="card p-4">
                        <h3 class="text-center">Sign Up</h3>
                        <form action="signup.php" method="POST">
                            <div class="mb-3">
                                <label for="signup_email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="signup_email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="signup_password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="signup_password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </form>
                        <p class="mt-3 text-center">Already have an account? <a href="#" data-bs-target="#authSlider" data-bs-slide-to="0">Login</a></p>
                    </div>
                </div>

                <!-- Admin Login Form -->
                <div class="carousel-item">
                    <div class="card p-4">
                        <h3 class="text-center">Admin Login</h3>
                        <form action="admin_login.php" method="POST">
                            <div class="mb-3">
                                <label for="admin_email" class="form-label">Email address</label>
                                <input type="text" class="form-control" id="admin_email" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="admin_password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="admin_password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <p class="text-center">Are you a user? <a href="#" data-bs-target="#authSlider" data-bs-slide-to="0">User Login</a></p>
                    </div>
                </div>
            </div>

           
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
