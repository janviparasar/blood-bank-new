<?php
include 'includes/header.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message_body = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($subject) || empty($message_body) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<p class='error'>Please fill in all fields and provide a valid email address.</p>";
    } else {
        // --- IMPORTANT ---
        // Replace your-admin-email@example.com with your actual email address
        $recipient = "your-admin-email@example.com";
        $headers = "From: $name <$email>";

        // The mail() function may not work on a local server (like XAMPP) without configuration.
        // It is expected to work on a live web server.
        if (mail($recipient, $subject, $message_body, $headers)) {
            $message = "<p class='success'>Thank you for contacting us! We will get back to you shortly.</p>";
        } else {
            $message = "<p class='error'>Oops! Something went wrong and we couldn't send your message.</p>";
        }
    }
}
?>
<div class="main-content">
    <h2>Contact Us</h2>
    <p>Have questions or feedback? Fill out the form below to get in touch with us.</p>
    <hr style="margin:20px 0;">

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <div style="flex: 2; min-width: 300px;">
            <?php echo $message; ?>
            <form action="contact.php" method="post">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="6" required></textarea>

                <input type="submit" value="Send Message">
            </form>
        </div>
        <div style="flex: 1; min-width: 250px; background: #f9f9f9; padding: 20px; border-radius: 8px;">
            <h3>Our Information</h3>
            <p><strong>Address:</strong><br>123 Life Saver Street,<br>Medical District,<br>Ahmedabad, Gujarat, India</p>
            <p><strong>Phone:</strong><br>+91 123 456 7890</p>
            <p><strong>Email:</strong><br>contact@bloodbank.com</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>