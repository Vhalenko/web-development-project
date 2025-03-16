<section class="main-content">
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1 class="mb-3"><?php echo $user->getUsername()?></h1>
                <h2 class=""><?php echo $user->getFullName()?></h2>
                <p class=""><?php echo $user->getEmail()?></p>
                <a href="/manage-profile" class="btn btn-primary">Edit Profile</a>
                <a href="/logout" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
        <hr class="my-4">
        <div class="container">
    <h2 class="text-center">Your Stats</h2>
    <div class="row">
        <div class="col-md-6">
            <canvas id="tasksChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="streakChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const tasksCompleted = <?php echo count($completedTasks) ?>;
    const tasksUncompleted = <?php echo count($uncumpletedTasks) ?>;
    const streakCount = <?php echo $user->getStreakCount(); ?>;
    const totalPoints = <?php echo $user->getTotalPoints(); ?>;

    new Chart(document.getElementById('tasksChart'), {
        type: 'doughnut',
        data: {
            labels: ['Completed Tasks', 'Remaining'],
            datasets: [{
                data: [tasksCompleted, tasksUncompleted],
                backgroundColor: ['#28a745', '#ddd']
            }]
        }
    });

    new Chart(document.getElementById('streakChart'), {
        type: 'bar',
        data: {
            labels: ['Current Streak'],
            datasets: [{
                data: [streakCount],
                backgroundColor: ['#007bff']
            }]
        },
        options: { responsive: true }
    });
</script>

    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/main.js"></script>