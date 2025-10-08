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
    
    <h3>Your Profile</h3>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($donor['email']); ?></p>
    <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($donor['blood_group']); ?></p>
    <p><strong>Contact:</strong> <?php echo htmlspecialchars($donor['contact']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($donor['address']); ?></p>
    <p><strong>Last Donation Date:</strong> <?php echo $donor['last_donation_date'] ? htmlspecialchars($donor['last_donation_date']) : 'Not available'; ?></p>

    <hr style="margin: 30px 0;">

    <h3>Your Donation History</h3>
    <table>
        <thead>
            <tr>
                <th>Donation Date</th>
                <th>Units Donated</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $history_sql = "SELECT donation_date, units_donated FROM donation_history WHERE donor_id = $donor_id ORDER BY donation_date DESC";
            $history_result = $conn->query($history_sql);

            if ($history_result->num_rows > 0) {
                while ($row = $history_result->fetch_assoc()) {
                    echo "<tr><td>" . htmlspecialchars($row['donation_date']) . "</td><td>" . htmlspecialchars($row['units_donated']) . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>You have no donation history yet.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>