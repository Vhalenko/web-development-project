<?php
require_once(__DIR__ . "../../controllers/UserController.php");

Route::add('/login', function () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userController = new UserController();
        $userController->login();
    }
    require_once(__DIR__ . "/../views/pages/login.php");
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
    require(__DIR__. "/../views/pages/profile.php");
});