<?php
include 'includes/header.php';
if (!isset($_SESSION['donor_id'])) {
    header("Location: login.php");
    exit();
}

$donor_id = $_SESSION['donor_id'];
$message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Update basic info
    $stmt = $conn->prepare("UPDATE donors SET name = ?, contact = ?, address = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $contact, $address, $donor_id);
    $stmt->execute();

    // Update password if a new one is provided
    if (!empty($password)) {
        $hashed_password = md5($password);
        $stmt_pass = $conn->prepare("UPDATE donors SET password = ? WHERE id = ?");
        $stmt_pass->bind_param("si", $hashed_password, $donor_id);
        $stmt_pass->execute();
    }
    
    $message = "<p class='success'>Profile updated successfully!</p>";
}

// Fetch current donor data to pre-fill the form
$result = $conn->query("SELECT name, email, contact, address FROM donors WHERE id = $donor_id");
$donor = $result->fetch_assoc();
?>

<div class="main-content login-form">
    <h2>Edit Your Profile</h2>
    <?php echo $message; ?>
    <form action="edit_profile.php" method="post">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($donor['name']); ?>" required>

        <label for="email">Email (Cannot be changed):</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($donor['email']); ?>" disabled>

        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($donor['contact']); ?>" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required><?php echo htmlspecialchars($donor['address']); ?></textarea>

        <hr style="margin: 15px 0;">
        <label for="password">New Password (Leave blank to keep current password):</label>
        <input type="password" id="password" name="password">

        <input type="submit" value="Update Profile">
    </form>
</div>

<?php include 'includes/footer.php'; ?>