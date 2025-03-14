<section class="main-content">
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img src="https://via.placeholder.com/150" alt="Profile Picture" class="rounded-circle mb-3">
                <h1 class="mb-3"><?php echo $username?></h1>
                <p class=""><?php echo $email?></p>
                <p><strong>Achievements:</strong> 10 Badges, 45 Tasks Completed</p>
                <a href="/manage-profile" class="btn btn-primary">Edit Profile</a>
                <a href="/logout" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h2 class="text-center">Your Stats</h2>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tasks Completed
                        <span class="badge bg-success rounded-pill"><?php echo $totalTasksCompleted?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Current Streak
                        <span class="badge bg-primary rounded-pill"><?php echo $streakCount?> Days</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Points
                        <span class="badge bg-warning text-dark rounded-pill">1200</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/main.js"></script>