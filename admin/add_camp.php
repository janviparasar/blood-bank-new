<?php
include '../includes/db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $organizer = $_POST['organizer'];
    $contact = $_POST['contact'];

    $stmt = $conn->prepare("INSERT INTO blood_camps (camp_title, location, camp_date, start_time, end_time, organizer, contact_info) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $title, $location, $date, $start_time, $end_time, $organizer, $contact);
    
    if ($stmt->execute()) {
        $message = "<p class='success'>New camp added successfully!</p>";
    } else {
        $message = "<p class='error'>Error: " . $stmt->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Camp</title>
    <link rel="stylesheet" href="../assets/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header><h1>Admin - Add New Camp</h1></header>
<div class="container">
    <div class="main-content login-form">
        <h2>New Camp Details</h2>
        <?php echo $message; ?>
        <form method="post">
            <label>Camp Title:</label><input type="text" name="title" required>
            <label>Location/Address:</label><textarea name="location" required></textarea>
            <label>Date:</label><input type="date" name="date" required>
            <label>Start Time:</label><input type="time" name="start_time" required>
            <label>End Time:</label><input type="time" name="end_time" required>
            <label>Organizer:</label><input type="text" name="organizer" required>
            <label>Contact Info:</label><input type="text" name="contact" required>
            <input type="submit" value="Add Camp">
        </form>
    </div>
</div>
</body>
</html>