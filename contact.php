<?php 
include ('header.php'); 
include ('db_connect.php'); // Include the database connection
?>
<font color="black">
<div class="container my-5 text-white">
    <h2 class="text-center">Contact Us</h2>
    <p class="text-center mb-4">
        Have questions or need help? We're here to assist you. Reach out to us anytime!
    </p>
    </font>
    <div class="row g-4">
        <!-- Contact Form -->
        <div class="col-md-6">
        <font color="black">
            <h4>Send Us a Message</h4>
        </font>
            <?php
            // Handle form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $message = mysqli_real_escape_string($conn, $_POST['message']);

                // Insert into database
                $query = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
                if (mysqli_query($conn, $query)) {
                    echo "<div class='alert alert-success'>Thank you for contacting us! We'll get back to you soon.</div>";
                } else {
                    echo "<div class='alert alert-danger'>There was an error. Please try again later.</div>";
                }
            }
            ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
      

        <!-- Contact Information -->
        <div class="col-md-6">
            <font color="black">
            <h4>Contact Information</h4>
            <p><strong>Address:</strong> Lone Wolf Headquarters, Coimbatore, Tamil Nadu, India</p>
            <p><strong>Phone:</strong> +91-123-456-7890</p>
            <p><strong>Email:</strong> support@lonewolf.com</p>
        </font>

            <!-- Google Maps Embed -->
            <div class="mt-4">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.899544645899!2d-122.41941568468189!3d37.77492957975995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858064d0e20b5d%3A0xe1f3bd84c82f393!2sCoimbatore!5e0!3m2!1sen!2sin!4v1687259795600!5m2!1sen!2sin" 
                    width="100%" 
                    height="200" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

<?php include ('footer.php'); ?>
