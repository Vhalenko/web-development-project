<?php
require_once(__DIR__ . "../../controllers/UserController.php");
require_once(__DIR__ . "../../controllers/TaskController.php");
require_once(__DIR__ . "/../controllers/StoreItemController.php");
require_once(__DIR__ . "/../controllers/PurchaseController.php");

Route::add('/purchase/([0-9]*)', function (int $id) {
    $purchseController = new PurchaseController();
    $userController = new UserController();
    $itemController = new StoreItemController();

    $user = $userController->getUserById($_SESSION['user']['id']);
    $item = $itemController->getStoreItemById($id);
    
    $purchseController->create($user, $item);
});