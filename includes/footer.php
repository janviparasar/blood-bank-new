</div> <footer>
        <div class="footer-content">
            <p>&copy; <?php echo date("Y"); ?> Blood Bank Management System. All Rights Reserved.</p>
            <div class="social-links">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const navLinks = document.getElementById('nav-links');
        const closeBtn = document.getElementById('close-btn');

        if (mobileMenuBtn && navLinks && closeBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                navLinks.classList.add('active');
            });

            closeBtn.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        }
    </script>
</body>
</html>