<?php
require_once(__DIR__ . "../../controllers/TaskController.php");
require_once(__DIR__ . "../../controllers/UserController.php");

Route::add('/tasks', function () {
    $taskController = new TaskController();
    $tasks = $taskController->getUncompletedTasksForUser();

    require_once(__DIR__ . "/../views/pages/tasks.php");
});

Route::add('/remove-task/([0-9]*)', function ($id) {
    $taskController = new TaskController();
    $taskController->removeTask($id);
});

Route::add('/add-task', function () {
    $taskController = new TaskController();
    $taskController->addTask();
}, ['get', 'post']);

Route::add('/edit-task/([0-9]*)', function ($id) {
    $taskController = new TaskController();
    $taskController->editTask($id);

}, ['get', 'post']);

Route::add('/complete-task/([0-9]*)', function ($id) {
    $taskController = new TaskController();
    $userController = new UserController();

    $userController->rewardUser();
    $taskController->completeTask($id);
    
});