<?php include 'includes/header.php'; ?>

<?php
// --- Fetching Dynamic Data ---

// 1. Get stats
$total_donors = $conn->query("SELECT COUNT(*) as count FROM donors")->fetch_assoc()['count'];
$total_donations_query = $conn->query("SELECT SUM(units_donated) as total FROM donation_history");
$total_donations = ($total_donations_query && $total_donations_query->num_rows > 0) ? $total_donations_query->fetch_assoc()['total'] : 0;
$total_requests_filled = $conn->query("SELECT COUNT(*) as count FROM blood_requests WHERE status='Approved'")->fetch_assoc()['count'];

// 2. Get the next upcoming camp
$today = date("Y-m-d");
$next_camp_result = $conn->query("SELECT * FROM blood_camps WHERE camp_date >= '$today' ORDER BY camp_date ASC LIMIT 1");
$next_camp = ($next_camp_result && $next_camp_result->num_rows > 0) ? $next_camp_result->fetch_assoc() : null;
?>

<div class="hero">  
    <div class="hero-content">
        <h2>Donate Blood, Save a Life</h2>
        <p>Your single donation can help save up to three lives. Join our community of heroes today.</p>
        <a href="register.php" class="cta-button">Become a Donor</a>
    </div>
</div>

<div class="stats-container">
    <div class="stat-item">
        <i class="fas fa-users"></i>
        <div class="stat-number" data-target="<?php echo $total_donors; ?>">0</div>
        <div class="stat-label">Registered Donors</div>
    </div>
    <div class="stat-item">
        <i class="fas fa-hand-holding-droplet"></i>
        <div class="stat-number" data-target="<?php echo $total_donations > 0 ? $total_donations : 0; ?>">0</div>
        <div class="stat-label">Units Collected</div>
    </div>
    <div class="stat-item">
        <i class="fas fa-heart-pulse"></i>
        <div class="stat-number" data-target="<?php echo $total_requests_filled; ?>">0</div>
        <div class="stat-label">Lives Saved</div>
    </div>
</div>


<div class="home-grid">
    <div class="main-content">
        <h2>Current Blood Stock</h2>
        <table>
            <thead>
                <tr>
                    <th>Blood Group</th>
                    <th>Available Units</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT blood_group, units FROM blood_inventory";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . htmlspecialchars($row['blood_group']) . "</td><td>" . htmlspecialchars($row['units']) . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="latest-camp">
        <h3>Next Donation Camp</h3>
        <?php if ($next_camp): ?>
            <h4 style="color: var(--primary-color);"><?php echo htmlspecialchars($next_camp['camp_title']); ?></h4>
            <p><strong>Date:</strong> <?php echo date("F j, Y", strtotime($next_camp['camp_date'])); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($next_camp['location']); ?></p>
            <a href="camps.php" style="font-weight: bold;">View All Camps &rarr;</a>
        <?php else: ?>
            <p>No upcoming camps scheduled. Please check back soon!</p>
        <?php endif; ?>
    </div>
</div>


<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.stat-number');
    const speed = 200; // The lower the number, the faster the count

    counters.forEach(counter => {
        const animate = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(animate, 10);
            } else {
                counter.innerText = target;
            }
        };
        animate();
    });
});
</script>