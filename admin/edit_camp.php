<?php
include '../includes/db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$camp_id = intval($_GET['id']);
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $organizer = $_POST['organizer'];
    $contact = $_POST['contact'];

    $stmt = $conn->prepare("UPDATE blood_camps SET camp_title=?, location=?, camp_date=?, start_time=?, end_time=?, organizer=?, contact_info=? WHERE id=?");
    $stmt->bind_param("sssssssi", $title, $location, $date, $start_time, $end_time, $organizer, $contact, $camp_id);
    
    if ($stmt->execute()) {
        $message = "<p class='success'>Camp details updated successfully!</p>";
    } else {
        $message = "<p class='error'>Error: " . $stmt->error . "</p>";
    }
}

// Fetch current camp data
$result = $conn->query("SELECT * FROM blood_camps WHERE id = $camp_id");
$camp = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Camp</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<header><h1>Admin - Edit Camp</h1></header>
<div class="container">
    <div class="main-content login-form">
        <h2>Edit Camp Details</h2>
        <?php echo $message; ?>
        <form method="post">
            <label>Camp Title:</label><input type="text" name="title" value="<?php echo htmlspecialchars($camp['camp_title']); ?>" required>
            <label>Location/Address:</label><textarea name="location" required><?php echo htmlspecialchars($camp['location']); ?></textarea>
            <label>Date:</label><input type="date" name="date" value="<?php echo htmlspecialchars($camp['camp_date']); ?>" required>
            <label>Start Time:</label><input type="time" name="start_time" value="<?php echo htmlspecialchars($camp['start_time']); ?>" required>
            <label>End Time:</label><input type="time" name="end_time" value="<?php echo htmlspecialchars($camp['end_time']); ?>" required>
            <label>Organizer:</label><input type="text" name="organizer" value="<?php echo htmlspecialchars($camp['organizer']); ?>" required>
            <label>Contact Info:</label><input type="text" name="contact" value="<?php echo htmlspecialchars($camp['contact_info']); ?>" required>
            <input type="submit" value="Update Camp">
        </form>
    </div>
</div>
</body>
</html>