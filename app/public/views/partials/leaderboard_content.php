<section class="main-content">
    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Leaderboard</h2>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Tasks Completed</th>
                    <th>Current Streak</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($topUsers as $user) { ?>
                    <tr>
                        <td><?= $count ?></td>
                        <td><strong><?= htmlspecialchars($user->getUsername()) ?></strong></td>
                        <td><?= htmlspecialchars($user->getTotalTasksCompleted()) ?></td>
                        <td><?= htmlspecialchars($user->getStreakCount()) ?> Days</td>
                        <td><?= htmlspecialchars($user->getPoints()) ?></td>
                    </tr>
                <?php
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>