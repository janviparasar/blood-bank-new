<?php
include '../includes/db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$search_query = "";
if (isset($_GET['search'])) {
    $search_term = $conn->real_escape_string($_GET['search']);
    $search_query = " WHERE name LIKE '%$search_term%' OR blood_group LIKE '%$search_term%'";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Donors</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<header><h1>Admin - Manage Donors</h1></header>
<nav class="admin-nav">
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_donors.php">Manage Donors</a>
    <a href="manage_requests.php">Manage Requests</a>
    <a href="manage_inventory.php">Manage Inventory</a>
    <a href="logout.php">Logout</a>
</nav>
<div class="container">
    <div class="main-content">
        <h2>Registered Donors</h2>
            <a href="export_donors.php" style="display:inline-block; margin-bottom: 20px; font-weight:bold; background-color: var(--success-color); color: white; padding: 8px 12px; border-radius: 5px;">Export to CSV</a>


        <form method="get" action="manage_donors.php" style="margin-bottom: 20px; display:flex; max-width: 400px;">
            <input type="text" name="search" placeholder="Search by name or blood group..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <input type="submit" value="Search">
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Blood Group</th>
                    <th>Contact</th>
                    <th>Last Donated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id, name, email, blood_group, contact, last_donation_date FROM donors" . $search_query;
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['blood_group']) . "</td>
                        <td>" . htmlspecialchars($row['contact']) . "</td>
                        <td>" . ($row['last_donation_date'] ? $row['last_donation_date'] : 'N/A') . "</td>
                        <td><a href='log_donation.php?donor_id={$row['id']}'>Log Donation</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>