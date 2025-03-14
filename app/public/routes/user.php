<?php
require_once(__DIR__ . "../../controllers/UserController.php");

Route::add('/login', function () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userController = new UserController();
        $userController->login();
    }
}, ['get', 'post']);

Route::add('/logout', function () {
    $userController = new UserController();
    $userController->logout();
    exit;
});

Route::add('/signup', function () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userController = new UserController();
        $userController->signUp();

        require_once(__DIR__ . "/../views/pages/login.php");
    }
}, ['get', 'post']);

Route::add('/leaderboard', function () {
    $userController = new UserController();
    $topUsers[] = $userController->getUsersByPoints();
    require_once(__DIR__ . "/../views/pages/leaderboard.php");
});

Route::add('/profile', function () {
    $username = $_SESSION['user']['username'];
    $email = $_SESSION['user']['email'];
    $streakCount = $_SESSION['user']['streak_count'];
    $totalTasksCompleted = $_SESSION['user']['total_tasks_completed'];

    require(__DIR__. "/../views/pages/profile.php");
});

Route::add('/manage-profile', function () {
    $username = $_SESSION['user']['username'];
    $email = $_SESSION['user']['email'];

    require(__DIR__. "/../views/pages/manage_profile.php");
});

Route::add('/update-account', function () {
    $userController = new UserController();
    $userController->editUser();

    require(__DIR__. "/../views/pages/manage_profile.php");
}, ['get', 'post']);