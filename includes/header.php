    <?php include 'db.php'; ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blood Bank Management System</title>
        <link rel="stylesheet" href="/blood-bank/assets/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body>
        <header>
            <h1>RaktSangam</h1>
            <h6>(Blood Bank Management System)</h6>
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
                    
                    <a href="/blood-bank/index.php">Home</a>
                    <a href="/blood-bank/camps.php">Donation Camps</a>
                    <a href="/blood-bank/request_blood.php">Request Blood</a>
                    <a href="/blood-bank/compatibility.php">Compatibility Chart</a>
                    <a href="/blood-bank/faq.php">FAQ</a> <a href="/blood-bank/contact.php">Contact Us</a>
                    
                    <?php if (isset($_SESSION['donor_id'])): ?>
                        <span class="nav-welcome">Welcome, <?php echo htmlspecialchars($_SESSION['donor_name']); ?></span>
                        <a href="/blood-bank/donor_dashboard.php">My Dashboard</a>
                        <a href="/blood-bank/logout.php">Logout</a>
                    <?php else: ?>
                        <a href="/blood-bank/login.php">Donor Login</a>
                        <a href="/blood-bank/register.php">Register as Donor</a>
                    <?php endif; ?>
                    
                    <a href="/blood-bank/admin/login.php">Admin Login</a>
                </div>
            </div>
        </nav>
        
        <div class="container">