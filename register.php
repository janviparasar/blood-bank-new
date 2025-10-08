<?php
include 'includes/header.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hashing the password
    $blood_group = $_POST['blood_group'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $sql = "INSERT INTO donors (name, email, password, blood_group, contact, address) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $password, $blood_group, $contact, $address);

    if ($stmt->execute()) {
        $message = "<p class='success'>Registration successful! You can now <a href='login.php'>login</a>.</p>";
    } else {
        $message = "<p class='error'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<div class="main-content login-form">
    <h2>Register as a Donor</h2>
    <?php echo $message; ?>
    <form action="register.php" method="post">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="blood_group">Blood Group:</label>
        <select id="blood_group" name="blood_group" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select>

        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>

        <input type="submit" value="Register">
    </form>
</div>

<?php include 'includes/footer.php'; ?>