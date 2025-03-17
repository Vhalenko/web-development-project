<section class="main-content">
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <?php
                $profilePicture = $user->getSelectedAvatar() ?: "default-profile.jpg"; // Use default if null or empty
                ?>
                <img src="../../assets/img/profiles/<?php echo htmlspecialchars($profilePicture); ?>"
                    class="rounded-circle mb-3"
                    alt="Profile Picture"
                    style="width: 150px; height: 150px; object-fit: cover;">

                <h1 class="mb-3"><?php echo htmlspecialchars($user->getUsername()); ?></h1>
                <h2><?php echo htmlspecialchars($user->getFullName()); ?></h2>
                <p><?php echo htmlspecialchars($user->getEmail()); ?></p>

                <a href="/manage-profile" class="btn btn-primary">Edit Profile</a>
                <a href="/logout" class="btn btn-outline-danger">Logout</a>
            </div>

        </div>
        <hr class="my-4">
        <div class="container">
            <h2 class="text-center">Your Stats</h2>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="tasksChart"
                        data-tasks-completed="<?php echo count($completedTasks); ?>"
                        data-tasks-uncompleted="<?php echo count($uncumpletedTasks); ?>">
                    </canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="streakChart"
                        data-streak-count="<?php echo $user->getStreakCount(); ?>">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../../assets/js/user.js"></script>
