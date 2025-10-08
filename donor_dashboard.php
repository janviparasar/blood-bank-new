<?php
include 'includes/header.php';
if (!isset($_SESSION['donor_id'])) {
    header("Location: login.php");
    exit();
}

$donor_id = $_SESSION['donor_id'];
$sql = "SELECT * FROM donors WHERE id = $donor_id";
$result = $conn->query($sql);
$donor = $result->fetch_assoc();
?>

<div class="main-content">
    <h2>Welcome, <?php echo htmlspecialchars($donor['name']); ?>!</h2>
        <a href="edit_profile.php" style="display:inline-block; margin-bottom: 20px; font-weight:bold;">Edit Your Profile</a>

    <h3>Your Profile</h3>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($donor['email']); ?></p>
    <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($donor['blood_group']); ?></p>
    <p><strong>Contact:</strong> <?php echo htmlspecialchars($donor['contact']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($donor['address']); ?></p>
    <p><strong>Last Donation Date:</strong> <?php echo $donor['last_donation_date'] ? htmlspecialchars($donor['last_donation_date']) : 'Not available'; ?></p>
</div>

<?php include 'includes/footer.php'; ?>