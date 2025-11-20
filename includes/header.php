<?php 
// Ensure session is started only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RaktSangam - Blood Bank Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/blood-bank/assets/style.css">
</head>
<body>
    <header>
        <div class="header-brand">
            <h1><i class="fas fa-heartbeat" style="color: #d32f2f;"></i> RaktSangam</h1>
            <h6>Blood Bank Management System</h6>
        </div>
    </header>

    <nav>
        <div class="nav-container">
            <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Open Menu">
                <i class="fas fa-bars"></i>
            </button>

            <div class="nav-links" id="nav-links">
                <button class="close-btn" id="close-btn" aria-label="Close Menu">
                    <i class="fas fa-times"></i>
                </button>
                
                <a href="/blood-bank/index.php"><i class="fas fa-home"></i> Home</a>
                <a href="/blood-bank/camps.php"><i class="fas fa-tent"></i> Camps</a>
                <a href="/blood-bank/request_blood.php"><i class="fas fa-hand-holding-heart"></i> Request Blood</a>
                <a href="/blood-bank/compatibility.php"><i class="fas fa-dna"></i> Compatibility</a>
                <a href="/blood-bank/faq.php"><i class="fas fa-question-circle"></i> FAQ</a> 
                <a href="/blood-bank/contact.php"><i class="fas fa-envelope"></i> Contact</a>
                
                <?php if (isset($_SESSION['donor_id'])): ?>
                    <span class="nav-welcome">Hi, <?php echo htmlspecialchars($_SESSION['donor_name']); ?></span>
                    <a href="/blood-bank/donor_dashboard.php">Dashboard</a>
                    <a href="/blood-bank/logout.php">Logout</a>
                <?php else: ?>
                    <a href="/blood-bank/login.php">Login</a>
                    <a href="/blood-bank/register.php">Register</a>
                <?php endif; ?>
                
                <?php if (!isset($_SESSION['donor_id']) && !isset($_SESSION['admin_id'])): ?>
                    <a href="/blood-bank/admin/login.php" style="border-left:1px solid rgba(255,255,255,0.2); margin-left:10px;">Admin</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    
    <div class="container">