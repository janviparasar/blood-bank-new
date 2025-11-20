<?php
include 'includes/header.php';
$message = '';
// ... (Keep your PHP Logic here) ... 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... logic ...
}
?>
<div class="main-content">
    <h2>Contact Us</h2>
    <p>Have questions? We are here to help.</p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; margin-top: 30px;">
        <div>
            <?php echo $message; ?>
            <form action="contact.php" method="post">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required placeholder="John Doe">

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="john@example.com">

                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required placeholder="How can we help?">

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required placeholder="Write your message here..."></textarea>

                <input type="submit" value="Send Message">
            </form>
        </div>

        <div style="background: var(--secondary-color); color: white; padding: 30px; border-radius: 10px;">
            <h3 style="color: white; border-bottom: 1px solid rgba(255,255,255,0.2);">Get in Touch</h3>
            <br>
            <p style="display:flex; gap:15px; align-items:center; margin-bottom:20px;">
                <i class="fas fa-map-marker-alt" style="font-size:1.5rem; color: var(--accent-color);"></i>
                <span>123 Life Saver Street,<br>Ahmedabad, Gujarat, India</span>
            </p>
            <p style="display:flex; gap:15px; align-items:center; margin-bottom:20px;">
                <i class="fas fa-phone-alt" style="font-size:1.5rem; color: var(--accent-color);"></i>
                <span>+91 123 456 7890</span>
            </p>
            <p style="display:flex; gap:15px; align-items:center; margin-bottom:20px;">
                <i class="fas fa-envelope" style="font-size:1.5rem; color: var(--accent-color);"></i>
                <span>contact@bloodbank.com</span>
            </p>
            
            <div class="social-links" style="margin-top: 30px; text-align: left;">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>