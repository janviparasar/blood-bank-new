<?php
include '../includes/db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blood_group = $_POST['blood_group'];
    $units = $_POST['units'];

    $stmt = $conn->prepare("UPDATE blood_inventory SET units = ? WHERE blood_group = ?");
    $stmt->bind_param("is", $units, $blood_group);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Blood Inventory</title>
    <link rel="stylesheet" href="../assets/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header><h1>Admin - Manage Inventory</h1></header>
<nav class="admin-nav">
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_donors.php">Manage Donors</a>
    <a href="manage_requests.php">Manage Requests</a>
    <a href="manage_inventory.php">Manage Inventory</a>
    <a href="logout.php">Logout</a>
</nav>
<div class="container">
    <div class="main-content">
        <h2>Update Blood Stock</h2>
        <table>
            <thead>
                <tr>
                    <th>Blood Group</th>
                    <th>Available Units</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM blood_inventory";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <form method='post'>
                            <td>{$row['blood_group']}<input type='hidden' name='blood_group' value='{$row['blood_group']}'></td>
                            <td><input type='number' name='units' value='{$row['units']}' min='0'></td>
                            <td><input type='submit' value='Update'></td>
                        </form>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>