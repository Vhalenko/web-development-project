<?php
require_once(__DIR__ . "../../controllers/UserController.php");
require_once(__DIR__ . "../../controllers/TaskController.php");
require_once(__DIR__ . "/../controllers/StoreItemController.php");

Route::add('/store', function () {
    $storeItemController = new StoreItemController();
    $storeItems = $storeItemController->getAllStoreItems();

    require(__DIR__ . "/../views/pages/store.php");
});