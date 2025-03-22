<?php
require_once(__DIR__ . "../../controllers/TaskController.php");
require_once(__DIR__ . "../../controllers/UserController.php");

Route::add('/tasks', function () {
    require_once(__DIR__ . "/../views/pages/tasks.php");
});