<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h4>TaskQuest</h4>
                <p>Your task management solution.</p>
            </div>

            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li><a href="/store" class="text-white text-decoration-none">Store</a></li>
                        <li><a href="/tasks" class="text-white text-decoration-none">Tasks</a></li>
                        <li><a href="/leaderboard" class="text-white text-decoration-none">Leaderboard</a></li>
                        <li><a href="/profile" class="text-white text-decoration-none">Profile</a></li>
                    <?php } else { ?>
                        <li><a href="/login-page" class="text-white text-decoration-none">Login</a></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-md-4 mb-3">
                <h5>Follow Us</h5>
                <div>
                    <!-- these links are fictional to fill the footer with more content -->
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i> Facebook</a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i> Twitter</a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i> Instagram</a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin"></i> LinkedIn</a>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <p>&copy; 2024 TaskQuest. All Rights Reserved.</p>
        </div>
    </div>
</footer>