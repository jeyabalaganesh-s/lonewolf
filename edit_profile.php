<?php
// Include the database connection and header
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

// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $image = $_FILES['profile_picture']['name'];
    $new_password = $_POST['new_password'];
    $current_password = $_POST['current_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if password is being changed
    if (!empty($new_password) && !empty($current_password) && !empty($confirm_password)) {
        // Check if current password is correct
        if (password_verify($current_password, $user['password'])) {
            // Check if new password matches the confirm password
            if ($new_password === $confirm_password) {
                // Hash the new password
                $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $sql_update_password = "UPDATE customer SET password = ? WHERE email = ?";
                $stmt_update_password = $conn->prepare($sql_update_password);
                $stmt_update_password->bind_param("ss", $new_password_hashed, $email);
                $stmt_update_password->execute();
                $stmt_update_password->close();
            } else {
                echo "New password and confirmation do not match.";
            }
        } else {
            echo "Current password is incorrect.";
        }
    }

    // Update profile (name, email, or profile picture)
    if (!empty($image)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            // Update the database with the new profile picture
            $sql_update = "UPDATE customer SET name = ?, email = ?, profile_picture = ? WHERE email = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ssss", $name, $email, $image, $email);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // If no image is uploaded, just update name and email
        $sql_update = "UPDATE customer SET name = ?, email = ? WHERE email = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("sss", $name, $email, $email);
        $stmt_update->execute();
        $stmt_update->close();
    }

    // Update session variable and redirect back to profile
    $_SESSION['email'] = $email;
    header("Location: profile.php");
    exit();
}
?>

<!-- Main Content -->
<div class="container my-5">
    <h1 class="text-center mb-4">Edit Profile</h1>
    <div class="row">
        <!-- Profile Form -->
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Update Your Profile</h5>
                    <form method="POST" enctype="multipart/form-data">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                            <small class="form-text text-muted">Upload a new profile picture (optional).</small>
                            <img src="<?php echo !empty($user['profile_picture']) ? 'uploads/'.$user['profile_picture'] : 'images/default-profile.png'; ?>" alt="Current Profile Picture" class="profile-picture mt-3" style="max-width: 10px; max-height: 10px; border-radius: 50%; object-fit: cover;">

                        </div>

                        <!-- Password Change -->
                        <hr>
                        <h5 class="card-title text-center">Change Your Password</h5>

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>

                        <!-- Save Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->

<?php
include 'userfooter.php';
?>
