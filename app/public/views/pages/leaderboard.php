<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.  "/../partials/head.php";?>
</head>
<body>

    <?php require_once __DIR__.  "/../partials/header_nav.php";?>

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
                    <tr>
                        <td>1</td>
                        <td><strong>JohnDoe</strong></td>
                        <td>150</td>
                        <td>25 Days</td>
                        <td>3000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>JaneSmith</strong></td>
                        <td>140</td>
                        <td>20 Days</td>
                        <td>2800</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><strong>TaskMaster</strong></td>
                        <td>130</td>
                        <td>18 Days</td>
                        <td>2600</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><strong>ProUser</strong></td>
                        <td>120</td>
                        <td>15 Days</td>
                        <td>2400</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><strong>Achiever99</strong></td>
                        <td>110</td>
                        <td>10 Days</td>
                        <td>2200</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <?php require_once __DIR__.  "/../partials/footer.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/main.js"></script>
</body>
</html>
