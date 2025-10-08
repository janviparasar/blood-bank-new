<?php
include '../includes/db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id_to_delete = intval($_GET['delete']);
    $conn->query("DELETE FROM blood_camps WHERE id = $id_to_delete");
    header("Location: manage_camps.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Blood Camps</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<header><h1>Admin - Manage Blood Camps</h1></header>
<nav class="admin-nav">
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_donors.php">Manage Donors</a>
    <a href="manage_requests.php">Manage Requests</a>
    <a href="manage_inventory.php">Manage Inventory</a>
    <a href="manage_camps.php">Manage Camps</a>
    <a href="logout.php">Logout</a>
</nav>
<div class="container">
    <div class="main-content">
        <h2>Upcoming Blood Donation Camps</h2>
        <a href="add_camp.php" style="display:inline-block; margin-bottom: 20px; font-weight:bold;">+ Add New Camp</a>
        <table>
            <thead>
                <tr>
                    <th>Camp Title</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM blood_camps ORDER BY camp_date DESC");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['camp_title']) . "</td>
                        <td>" . htmlspecialchars($row['location']) . "</td>
                        <td>" . htmlspecialchars($row['camp_date']) . "</td>
                        <td>" . date('h:i A', strtotime($row['start_time'])) . " - " . date('h:i A', strtotime($row['end_time'])) . "</td>
                        <td>
                            <a href='edit_camp.php?id={$row['id']}'>Edit</a> | 
                            <a href='?delete={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this camp?');\">Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>