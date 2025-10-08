<?php
include '../includes/db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle status update
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action']; // 'approve' or 'reject'
    $new_status = ($action == 'approve') ? 'Approved' : 'Rejected';
    
    $stmt = $conn->prepare("UPDATE blood_requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $id);
    $stmt->execute();
    header("Location: manage_requests.php");
    exit();
}

// Handle filtering
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'All';
$sql_where = '';
if ($filter_status != 'All' && in_array($filter_status, ['Pending', 'Approved', 'Rejected'])) {
    $sql_where = " WHERE status = '" . $conn->real_escape_string($filter_status) . "'";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Blood Requests</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<header><h1>Admin - Manage Requests</h1></header>
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
        <h2>Blood Requests</h2>

        <form method="get" action="manage_requests.php" style="margin-bottom: 20px; display:flex; max-width: 300px; gap: 10px; align-items:center;">
            <label for="status">Filter by Status:</label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="All" <?php if ($filter_status == 'All') echo 'selected'; ?>>All</option>
                <option value="Pending" <?php if ($filter_status == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="Approved" <?php if ($filter_status == 'Approved') echo 'selected'; ?>>Approved</option>
                <option value="Rejected" <?php if ($filter_status == 'Rejected') echo 'selected'; ?>>Rejected</option>
            </select>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Blood Group</th>
                    <th>Units</th>
                    <th>Hospital</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM blood_requests" . $sql_where . " ORDER BY request_date DESC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['patient_name']) . "</td>
                        <td>" . htmlspecialchars($row['blood_group']) . "</td>
                        <td>" . htmlspecialchars($row['units_required']) . "</td>
                        <td>" . htmlspecialchars($row['hospital_name']) . "</td>
                        <td>" . htmlspecialchars($row['contact_person']) . " (" . htmlspecialchars($row['contact_number']) . ")</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                        <td>";
                        if ($row['status'] == 'Pending') {
                            echo "<a href='?action=approve&id={$row['id']}'>Approve</a> | <a href='?action=reject&id={$row['id']}'>Reject</a>";
                        }
                    echo "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>