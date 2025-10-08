<?php
include '../includes/db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';
$admin_id = $_SESSION['admin_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current password from the database
    $result = $conn->query("SELECT password FROM admin WHERE id = $admin_id");
    $admin = $result->fetch_assoc();
    $current_hashed_password = $admin['password'];

    // Verify the current password
    if (md5($current_password) !== $current_hashed_password) {
        $message = "<p class='error'>Your current password is incorrect.</p>";
    } elseif ($new_password !== $confirm_password) {
        $message = "<p class='error'>New password and confirm password do not match.</p>";
    } elseif (strlen($new_password) < 5) {
        $message = "<p class='error'>Password must be at least 5 characters long.</p>";
    } else {
        // Update the password
        $new_hashed_password = md5($new_password);
        $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $new_hashed_password, $admin_id);
        if ($stmt->execute()) {
            $message = "<p class='success'>Password changed successfully!</p>";
        } else {
            $message = "<p class='error'>An error occurred. Please try again.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Admin Password</title>
    <link rel="stylesheet" href="../assets/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header><h1>Admin - Change Password</h1></header>
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
    <div class="main-content login-form">
        <h2>Change Your Password</h2>
        <?php echo $message; ?>
        <form method="post">
            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Change Password">
        </form>
    </div>
</div>
</body>
</html>