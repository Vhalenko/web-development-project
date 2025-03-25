<?php
require_once(__DIR__ . "../../controllers/UserController.php");
require_once(__DIR__ . "../../controllers/TaskController.php");
require_once(__DIR__ . "../../controllers/StoreItemController.php");
require_once(__DIR__ . "../../controllers/PurchaseController.php");

const DEFAULT_AVATAR = 'default-profile.jpg';

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
    }
}, ['get', 'post']);

Route::add('/leaderboard', function () {
    $userController = new UserController();
    $topUsers = $userController->getUsersByPoints();

    require_once(__DIR__ . "/../views/pages/leaderboard.php");
});


Route::add('/profile', function () {
    $userController = new UserController();
    $taskController = new TaskController();

    if (!isset($_SESSION['user']['id'])) {
        header("Location: /login-page");
        exit;
    }

    $user = $userController->getUserById($_SESSION['user']['id']);
    $completedTasks = $taskController->getCompletedTasks($user->getUserId());
    $uncumpletedTasks = $taskController->getUncompletedTasks($user->getUserId());

    require(__DIR__ . "/../views/pages/profile.php");
});

Route::add('/manage-profile', function () {
    $userController = new UserController();
    $purchaseController = new PurchaseController();
    $storeItemController = new StoreItemController();

    if (!isset($_SESSION['user']['id'])) {
        header("Location: /login-page");
        exit;
    }

    $user = $userController->getUserById($_SESSION['user']['id']);
    $purchases = $purchaseController->getPurchasesForUser($user->getUserId());

    $availablePictures = [DEFAULT_AVATAR];
    foreach ($purchases as $purchase) {
        $item = $storeItemController->getStoreItemById($purchase->getItemId());
        $availablePictures[] = $item->getAssetPath();
    }

    $profilePicture = $user->getSelectedAvatar();

    require(__DIR__ . "/../views/pages/manage_profile.php");
});

Route::add('/update-account', function () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userController = new UserController();
        $userController->editUser();
    }
    require(__DIR__ . "/../views/pages/manage_profile.php");
}, ['get', 'post']);
