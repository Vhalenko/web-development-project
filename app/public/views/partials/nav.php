<?php
if (isset($_SESSION['user'])) {
    $userController = new UserController();
    $userId = $_SESSION['user']['id'];
    $user = $userController->getUserById($userId);
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <img src="../../assets/img/logo.webp" alt="" class="logo">
        <a class="navbar-brand" href="#">TaskQuest</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php if (isset($_SESSION['user'])) { ?>
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/store">Store</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tasks">Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/leaderboard">Leaderboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-2" href="/profile">Profile</a>
                    </li>
                    <li class="nav-item d-flex align-items-center ms-3">
                        <img class="coin-icon" src="../../assets/img/coin.png" alt="Coins">
                        <span class="ms-2 text-light total-points"><?= $user->getTotalPoints() ?></span>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="btn btn-outline-light" href="/login-page">Login</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>