<?php
include '../includes/db.php';
if (!isset($_SESSION['admin_id'])) {
    // Redirect if not logged in
    header("Location: login.php");
    exit();
}

// Set headers to force download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=donors_list_' . date('Y-m-d') . '.csv');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output the column headings
fputcsv($output, array('ID', 'Name', 'Email', 'Blood Group', 'Contact', 'Address', 'Last Donation Date'));

// Fetch the data
$result = $conn->query("SELECT id, name, email, blood_group, contact, address, last_donation_date FROM donors ORDER BY id ASC");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
exit();
?>