<?php
include '../includes/db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch stats
$total_donors = $conn->query("SELECT COUNT(*) as count FROM donors")->fetch_assoc()['count'];
$pending_requests = $conn->query("SELECT COUNT(*) as count FROM blood_requests WHERE status='Pending'")->fetch_assoc()['count'];
$total_units = $conn->query("SELECT SUM(units) as total FROM blood_inventory")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header><h1>Admin Dashboard</h1></header>
<nav class="admin-nav">
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_donors.php">Manage Donors</a>
    <a href="manage_requests.php">Manage Requests</a>
    <a href="manage_inventory.php">Manage Inventory</a>
    <a href="manage_camps.php">Manage Camps</a>
        <a href="change_password.php">Change Password</a>
 <a href="logout.php">Logout</a>
</nav>
<div class="container">
    <div class="main-content">
        <h2>System Overview</h2>
        <p><strong>Total Registered Donors:</strong> <?php echo $total_donors; ?></p>
        <p><strong>Pending Blood Requests:</strong> <?php echo $pending_requests; ?></p>
        <p><strong>Total Blood Units Available:</strong> <?php echo $total_units; ?></p>
    </div>
</div>
</body>
</html>