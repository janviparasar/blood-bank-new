<?php
include '../includes/db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch stats
$total_donors = $conn->query("SELECT COUNT(*) as count FROM donors")->fetch_assoc()['count'];
$pending_requests = $conn->query("SELECT COUNT(*) as count FROM blood_requests WHERE status='Pending'")->fetch_assoc()['count'];
$total_units_query = $conn->query("SELECT SUM(units) as total FROM blood_inventory");
$total_units = ($total_units_query && $total_units_query->num_rows > 0) ? $total_units_query->fetch_assoc()['total'] : 0;
$total_camps = $conn->query("SELECT COUNT(*) as count FROM blood_camps")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Blood Bank</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    
    <style>
        /* Admin Specific Overrides */
        body { background-color: #f0f2f5; }
        
        .admin-header {
            background: var(--secondary-color);
            color: white;
            padding: 15px 0;
            text-align: center;
            border-bottom: 4px solid var(--primary-color);
        }
        
        .admin-nav {
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            padding: 0 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .admin-nav a {
            color: var(--secondary-color);
            padding: 15px 20px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .admin-nav a:hover, .admin-nav a.active {
            color: var(--primary-color);
            background: #fafafa;
            border-bottom: 3px solid var(--primary-color);
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s ease;
            border-left: 5px solid var(--primary-color);
        }
        
        .card:hover { transform: translateY(-5px); }
        
        .card-info h3 { font-size: 2.5rem; margin: 0; color: var(--secondary-color); font-weight: 700; }
        .card-info p { margin: 5px 0 0; color: #666; font-size: 0.95rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;}
        
        .card-icon {
            font-size: 3rem;
            color: rgba(183, 28, 28, 0.15); /* Very light primary color */
        }

        /* Quick Actions Section */
        .quick-actions {
            margin-top: 40px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        
        .action-btn {
            display: inline-block;
            background: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 0.9rem;
            margin-right: 10px;
            margin-bottom: 10px;
            transition: background 0.3s;
        }
        .action-btn:hover { background: var(--primary-color); color: white; }
    </style>
</head>
<body>

<header class="admin-header">
    <h1><i class="fas fa-user-shield"></i> Admin Portal</h1>
</header>

<nav class="admin-nav">
    <a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="manage_donors.php"><i class="fas fa-users"></i> Donors</a>
    <a href="manage_requests.php"><i class="fas fa-clipboard-list"></i> Requests</a>
    <a href="manage_inventory.php"><i class="fas fa-flask"></i> Inventory</a>
    <a href="manage_camps.php"><i class="fas fa-tent"></i> Camps</a>
    <a href="change_password.php"><i class="fas fa-key"></i> Password</a>
    <a href="logout.php" style="color: var(--primary-color);"><i class="fas fa-sign-out-alt"></i> Logout</a>
</nav>

<div class="container">
    <div class="main-content" style="background: transparent; box-shadow: none; padding: 0;">
        <h2 style="border-bottom: none; margin-bottom: 10px;">System Overview</h2>
        <p style="color: #666; margin-bottom: 30px;">Welcome back, Admin. Here is what's happening today.</p>

        <div class="dashboard-grid">
            <div class="card">
                <div class="card-info">
                    <h3><?php echo $total_donors; ?></h3>
                    <p>Registered Donors</p>
                </div>
                <div class="card-icon"><i class="fas fa-users"></i></div>
            </div>

            <div class="card" style="border-left-color: #ffa000;">
                <div class="card-info">
                    <h3><?php echo $pending_requests; ?></h3>
                    <p>Pending Requests</p>
                </div>
                <div class="card-icon" style="color: rgba(255, 160, 0, 0.2);"><i class="fas fa-hourglass-half"></i></div>
            </div>

            <div class="card" style="border-left-color: #d32f2f;">
                <div class="card-info">
                    <h3><?php echo $total_units ? $total_units : '0'; ?></h3>
                    <p>Total Units Available</p>
                </div>
                <div class="card-icon" style="color: rgba(211, 47, 47, 0.15);"><i class="fas fa-tint"></i></div>
            </div>
            
            <div class="card" style="border-left-color: #1976d2;">
                <div class="card-info">
                    <h3><?php echo $total_camps; ?></h3>
                    <p>Total Camps</p>
                </div>
                <div class="card-icon" style="color: rgba(25, 118, 210, 0.15);"><i class="fas fa-campground"></i></div>
            </div>
        </div>

        <div class="quick-actions">
            <h3 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px;">Quick Actions</h3>
            <a href="add_camp.php" class="action-btn"><i class="fas fa-plus"></i> Add New Camp</a>
            <a href="manage_requests.php?status=Pending" class="action-btn"><i class="fas fa-check-circle"></i> Review Pending Requests</a>
            <a href="export_donors.php" class="action-btn"><i class="fas fa-file-csv"></i> Export Donor List</a>
        </div>

    </div>
</div>

</body>
</html>