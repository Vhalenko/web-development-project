<?php
require_once(__DIR__ . "../../controllers/TaskController.php");

Route::add('/tasks', function () {
    $user = $_SESSION['user'];
    $taskController = new TaskController();
    $tasks[] = $taskController->getTasksForUser($user);

    require_once(__DIR__ . "/../views/pages/tasks.php");
});

Route::add('/remove-task([0-9]*)', function ($id) {
    $taskController = new TaskController();
    $task = $taskController->getTask($id);
    $tasks[] = $taskController->removeTask($task);
});

Route::add('/add-task', function () {
    $taskController = new TaskController();
    $taskController->addTask();

    require_once(__DIR__ . "/../views/pages/tasks.php");
});

Route::add('/edit-task([0-9]*)', function ($id) {
    $taskController = new TaskController();
    $task = $taskController->getTask($id);
    $taskController->editTask($task);

    require_once(__DIR__ . "/../views/pages/tasks.php");
});

Route::add('/complete-task([0-9]*)', function ($id) {
    $taskController = new TaskController();
    $taskController->completeTask($id);
});