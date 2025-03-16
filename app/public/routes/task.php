<?php
require_once(__DIR__ . "../../controllers/TaskController.php");
require_once(__DIR__ . "../../controllers/UserController.php");

Route::add('/tasks', function () {
    $taskController = new TaskController();

    // Get filter and sort parameters from query string
    $sort = $_GET['sort'] ?? 'deadline';
    $filter = $_GET['filter'] ?? 'incompleted';

    // Get filtered tasks
    if ($filter == 'completed') {
        $tasks = $taskController->getCompletedTasks();
    } elseif ($filter == 'incompleted') {
        $tasks = $taskController->getUncompletedTasks();
    } else {
        $tasks = $taskController->getAllTasks();
    }

    // Apply sorting
    if ($sort == 'priority') {
        $tasks = $taskController->sortTasksByPriority($tasks);
    } else {
        $tasks = $taskController->sortTasksByDeadline($tasks);
    }

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

// Route::add('/tasks/sort/priority', function () {
//     $taskController = new TaskController();
//     $tasks = $taskController->sortTasksByPriority($taskController->getUncompletedTasks());

//     require_once(__DIR__ . "/../views/pages/tasks.php");
// });

// Route::add('/tasks/filter/completed', function () {
//     $taskController = new TaskController();
//     $tasks = $taskController->sortTasksByDeadline($taskController->getCompletedTasks());

//     require_once(__DIR__ . "/../views/pages/tasks.php");
// });

// Route::add('/tasks/filter/incompleted', function () {
//     $taskController = new TaskController();
//     $tasks = $taskController->sortTasksByDeadline($taskController->getUncompletedTasks());

//     require_once(__DIR__ . "/../views/pages/tasks.php");
// });

// Route::add('/tasks/filter/all', function () {
//     $taskController = new TaskController();
//     $tasks = $taskController->sortTasksByDeadline($taskController->getAllTasks());

//     require_once(__DIR__ . "/../views/pages/tasks.php");
// });