<?php include 'includes/header.php'; ?>

<?php
// --- Fetching Dynamic Data ---
$total_donors = $conn->query("SELECT COUNT(*) as count FROM donors")->fetch_assoc()['count'];
$total_donations_query = $conn->query("SELECT SUM(units_donated) as total FROM donation_history");
$total_donations = ($total_donations_query && $total_donations_query->num_rows > 0) ? $total_donations_query->fetch_assoc()['total'] : 0;
$total_requests_filled = $conn->query("SELECT COUNT(*) as count FROM blood_requests WHERE status='Approved'")->fetch_assoc()['count'];

$today = date("Y-m-d");
$next_camp_result = $conn->query("SELECT * FROM blood_camps WHERE camp_date >= '$today' ORDER BY camp_date ASC LIMIT 1");
$next_camp = ($next_camp_result && $next_camp_result->num_rows > 0) ? $next_camp_result->fetch_assoc() : null;
?>

<div class="hero">  
    <div class="hero-content">
        <h2>Donate Blood, Save a Life</h2>
        <p>Your single donation can help save up to three lives. Join our community of heroes today.</p>
        <a href="register.php" class="cta-button">Become a Donor <i class="fas fa-arrow-right"></i></a>
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

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
    
    <div class="main-content">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h2 style="margin:0; border:none;">Current Blood Stock</h2>
            <i class="fas fa-flask" style="color:var(--primary-color); font-size:1.5rem;"></i>
        </div>
        <table style="margin-top:0;">
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
                        echo "<tr>
                            <td data-label='Blood Group'><strong>" . htmlspecialchars($row['blood_group']) . "</strong></td>
                            <td data-label='Available Units'>" . htmlspecialchars($row['units']) . " Units</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="main-content" style="background: #fff8f8; border: 1px solid #ffcdd2;">
        <h3 style="color:var(--primary-color);"><i class="fas fa-calendar-alt"></i> Next Camp</h3>
        <?php if ($next_camp): ?>
            <h2 style="font-size:1.4rem; margin-top:10px; border:none; padding:0;"><?php echo htmlspecialchars($next_camp['camp_title']); ?></h2>
            <p style="margin-bottom:5px;"><i class="far fa-calendar"></i> <?php echo date("F j, Y", strtotime($next_camp['camp_date'])); ?></p>
            <p style="margin-bottom:15px;"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($next_camp['location']); ?></p>
            <a href="camps.php" class="cta-button" style="padding:10px 20px; font-size:0.9rem;">View Details</a>
        <?php else: ?>
            <p>No upcoming camps scheduled. Please check back soon!</p>
        <?php endif; ?>
    </div>

</div>

<?php include 'includes/footer.php'; ?>

<script>
// Dynamic Counter Animation
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.stat-number');
    const speed = 100; 

    counters.forEach(counter => {
        const animate = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = Math.ceil(target / speed);

            if (count < target) {
                counter.innerText = count + increment;
                setTimeout(animate, 20);
            } else {
                counter.innerText = target;
            }
        };
        animate();
    });
});
</script>