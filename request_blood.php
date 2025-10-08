<?php
include 'includes/header.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patient_name'];
    $blood_group = $_POST['blood_group'];
    $units_required = $_POST['units_required'];
    $hospital_name = $_POST['hospital_name'];
    $contact_person = $_POST['contact_person'];
    $contact_number = $_POST['contact_number'];

    $sql = "INSERT INTO blood_requests (patient_name, blood_group, units_required, hospital_name, contact_person, contact_number) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisss", $patient_name, $blood_group, $units_required, $hospital_name, $contact_person, $contact_number);

    if ($stmt->execute()) {
        $message = "<p class='success'>Your request has been submitted successfully. We will contact you soon.</p>";
    } else {
        $message = "<p class='error'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<div class="main-content login-form">
    <h2>Request for Blood</h2>
    <?php echo $message; ?>
    <form action="request_blood.php" method="post">
        <label for="patient_name">Patient Name:</label>
        <input type="text" id="patient_name" name="patient_name" required>

        <label for="blood_group">Blood Group:</label>
        <select id="blood_group" name="blood_group" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select>

        <label for="units_required">Units Required:</label>
        <input type="number" id="units_required" name="units_required" required min="1">

        <label for="hospital_name">Hospital Name & Address:</label>
        <input type="text" id="hospital_name" name="hospital_name" required>

        <label for="contact_person">Contact Person:</label>
        <input type="text" id="contact_person" name="contact_person" required>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required>

        <input type="submit" value="Submit Request">
    </form>
</div>

<?php include 'includes/footer.php'; ?>