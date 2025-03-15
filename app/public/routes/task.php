<?php
require_once(__DIR__ . "../../controllers/TaskController.php");

Route::add('/tasks', function () {
    $userId = $_SESSION['user']['id'];
    $taskController = new TaskController();
    $tasks = $taskController->getTasksForUser($userId);

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

Route::add('/edit-task([0-9]*)', function ($id) {
    $taskController = new TaskController();
    $task = $taskController->getTask($id);
    $taskController->editTask($task);

    require_once(__DIR__ . "/../views/pages/tasks.php");
});

Route::add('/complete-task/([0-9]*)', function ($id) {
    $taskController = new TaskController();
    $taskController->completeTask($id);
});