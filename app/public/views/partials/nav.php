<?php
require_once(__DIR__ . "/../../controllers/UserController.php");
$userController = new UserController();
$user = $userController->getUserById($_SESSION['user']['id']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
    <div class="container d-flex align-items-center">
        <!-- Logo with a fixed height to maintain aspect ratio -->
        <img src="../../assets/img/logo.webp" alt="" class="logo">
        <a class="navbar-brand ms-2" href="#">TaskQuest</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
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
                    <span class="ms-2 text-light total-points"><?= $user->getTotalPoints() ?></span> <!-- Example coin count -->
                </li>
            </ul>
        </div>
    </div>
</nav>