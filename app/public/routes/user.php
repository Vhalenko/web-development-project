<?php
require_once(__DIR__ . "../../controllers/UserController.php");
require_once(__DIR__ . "../../controllers/TaskController.php");

Route::add('/login', function () {
    $userController = new UserController();
    $userController->login();
}, ['get', 'post']);

Route::add('/logout', function () {
    $userController = new UserController();
    $userController->logout();
    exit;
});

Route::add('/signup', function () {
    $userController = new UserController();
    $userController->signUp();
}, ['get', 'post']);

Route::add('/leaderboard', function () {
    $userController = new UserController();
    $topUsers = $userController->getUsersByPoints();

    require_once(__DIR__ . "/../views/pages/leaderboard.php");
});


Route::add('/profile', function () {
    $userController = new UserController();
    $taskController = new TaskController();

    $user = $userController->getUserById($_SESSION['user']['id']);
    $completedTasks = $taskController->getCompletedTasksForUser($user->getUserId());
    $uncumpletedTasks = $taskController->getUncompletedTasksForUser($user->getUserId());

    require(__DIR__ . "/../views/pages/profile.php");
});

Route::add('/manage-profile', function () {
    $userController = new UserController();
    $user = $userController->getUserById($_SESSION['user']['id']);

    require(__DIR__ . "/../views/pages/manage_profile.php");
});

Route::add('/update-account', function () {
    $userController = new UserController();
    $userController->editUser();

    require(__DIR__ . "/../views/pages/manage_profile.php");
}, ['get', 'post']);
