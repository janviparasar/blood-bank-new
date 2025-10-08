<?php include 'includes/header.php'; ?>

<style>
/* Simple styling for camp cards */
.camp-card {
    background: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.camp-card h3 {
    margin-top: 0;
    color: var(--primary-color);
}
</style>

<div class="main-content">
    <h2>Upcoming Blood Donation Camps</h2>
    <p>Find a camp near you and save a life. Your participation is greatly appreciated!</p>
    <hr style="margin: 20px 0;">

    <?php
    $today = date("Y-m-d");
    $result = $conn->query("SELECT * FROM blood_camps WHERE camp_date >= '$today' ORDER BY camp_date ASC");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='camp-card'>";
            echo "<h3>" . htmlspecialchars($row['camp_title']) . "</h3>";
            echo "<p><strong>Date:</strong> " . date("F j, Y", strtotime($row['camp_date'])) . "</p>";
            echo "<p><strong>Time:</strong> " . date('h:i A', strtotime($row['start_time'])) . " to " . date('h:i A', strtotime($row['end_time'])) . "</p>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
            echo "<p><strong>Organized by:</strong> " . htmlspecialchars($row['organizer']) . "</p>";
            echo "<p><strong>Contact:</strong> " . htmlspecialchars($row['contact_info']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>There are no upcoming blood donation camps scheduled at the moment. Please check back later.</p>";
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>