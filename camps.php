<?php include 'includes/header.php'; ?>

<style>
.camp-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 25px;
}
.camp-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: var(--shadow-md);
    overflow: hidden;
    transition: var(--transition);
    border: 1px solid #eee;
}
.camp-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}
.camp-header {
    background: var(--primary-color);
    color: white;
    padding: 15px 20px;
}
.camp-header h3 { margin: 0; font-size: 1.2rem; color: white; }
.camp-body { padding: 20px; }
.camp-info { margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px; }
.camp-info i { color: var(--primary-color); margin-top: 4px; }
</style>

<div class="main-content" style="background:transparent; padding:0; box-shadow:none;">
    <h2 style="background:#fff; padding:20px; border-radius:10px;">Upcoming Blood Donation Camps</h2>
    
    <div class="camp-grid">
    <?php
    $today = date("Y-m-d");
    $result = $conn->query("SELECT * FROM blood_camps WHERE camp_date >= '$today' ORDER BY camp_date ASC");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='camp-card'>
                <div class='camp-header'>
                    <h3>" . htmlspecialchars($row['camp_title']) . "</h3>
                </div>
                <div class='camp-body'>
                    <div class='camp-info'><i class='far fa-calendar-alt'></i> <span>" . date("F j, Y", strtotime($row['camp_date'])) . "</span></div>
                    <div class='camp-info'><i class='far fa-clock'></i> <span>" . date('h:i A', strtotime($row['start_time'])) . " - " . date('h:i A', strtotime($row['end_time'])) . "</span></div>
                    <div class='camp-info'><i class='fas fa-map-marker-alt'></i> <span>" . htmlspecialchars($row['location']) . "</span></div>
                    <div class='camp-info'><i class='fas fa-user-tie'></i> <span>" . htmlspecialchars($row['organizer']) . "</span></div>
                    <div class='camp-info'><i class='fas fa-phone'></i> <span>" . htmlspecialchars($row['contact_info']) . "</span></div>
                </div>
            </div>";
        }
    } else {
        echo "<p style='background:#fff; padding:20px; border-radius:10px; width:100%;'>There are no upcoming blood donation camps scheduled at the moment.</p>";
    }
    ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>