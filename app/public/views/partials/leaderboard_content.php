<section class="main-content">
    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Leaderboard</h2>

        <div class="card shadow-lg mb-4">
            <div class="card-body">
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
                            <tr class="<?= $count % 2 == 0 ? 'bg-light' : '' ?>">
                                <td>
                                    <?php
                                    if ($count == 1) {
                                        echo '<i class="bi bi-trophy-fill text-warning"></i>';
                                    } elseif ($count == 2) {
                                        echo '<i class="bi bi-trophy-fill text-secondary"></i>';
                                    } elseif ($count == 3) {
                                        echo '<i class="bi bi-trophy-fill text-bronze"></i>';
                                    } else {
                                        echo $count;
                                    }
                                    ?>
                                </td>
                                <td><strong><?= htmlspecialchars($user->getUsername()) ?></strong></td>
                                <td><?= htmlspecialchars($user->getTotalTasksCompleted()) ?></td>
                                <td><?= htmlspecialchars($user->getStreakCount()) ?> Days</td>
                                <td><?= htmlspecialchars($user->getTotalPoints()) ?></td>
                            </tr>
                        <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Optional: Include Bootstrap icons for trophy icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Optional: Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>