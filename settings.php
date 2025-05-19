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

// Handle form submission to update settings
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notification = isset($_POST['notification']) ? 1 : 0; // Checkbox for notifications
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $current_password = $_POST['current_password'];
    $confirm_password = $_POST['confirm_password'];

    // Handle password change if provided
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

    // Update email and notification preferences
    $sql_update = "UPDATE customer SET email = ?, notification = ? WHERE email = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sis", $email, $notification, $user['email']);
    $stmt_update->execute();
    $stmt_update->close();

    // Update session variable and redirect back to settings
    $_SESSION['email'] = $email;
    header("Location: settings.php");
    exit();
}
?>

<!-- Main Content -->
<div class="container my-5">
    <h1 class="text-center mb-4">Settings</h1>
    <div class="row">
        <!-- Settings Form -->
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Update Your Settings</h5>
                    <form method="POST">
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>

                        <!-- Notification Preferences -->
                        <div class="mb-3">
                            <label for="notification" class="form-label">Notification Preferences</label><br>
                            <input type="checkbox" id="notification" name="notification" <?php echo $user['notification'] == 1 ? 'checked' : ''; ?>>
                            <label for="notification" class="form-label">Receive email notifications about orders and promotions</label>
                        </div>

                        <!-- Password Change -->
                        <hr>
                        <h5 class="card-title text-center">Change Your Password</h5>

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
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
