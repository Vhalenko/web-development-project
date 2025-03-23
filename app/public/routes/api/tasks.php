<?php

require_once(__DIR__ . '/../../controllers/TaskController.php');
require_once(__DIR__ . '/../../controllers/UserController.php');

Route::add('/api/tasks', function () {
    header('Content-Type: application/json');

    $taskController = new TaskController();

    $sort = $_GET['sort'] ?? 'deadline';
    $filter = $_GET['filter'] ?? 'incompleted';

    if ($filter == 'completed') {
        $tasks = $taskController->getCompletedTasks();
    } elseif ($filter == 'incompleted') {
        $tasks = $taskController->getUncompletedTasks();
    } else {
        $tasks = $taskController->getAllTasks();
    }

    if ($sort == 'priority') {
        $tasks = $taskController->sortTasksByPriority($tasks);
    } else {
        $tasks = $taskController->sortTasksByDeadline($tasks);
    }
    echo json_encode(["tasks" => $tasks]);
}, ['get']);

Route::add('/api/task', function () {
    header('Content-Type: application/json');

    $taskController = new TaskController();

    if ($taskController->addTask()) {
        echo json_encode(["message" => "Task added successfully"]);
    } 
}, ['post']);

Route::add('/api/task/([0-9]*)', function ($id) {
    header('Content-Type: application/json');

    $taskController = new TaskController();

    if ($taskController->removeTask($id)) {
        echo json_encode(["message" => "Task removed successfully"]);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Failed to remove task"]);
    }
}, ['delete']);

Route::add('/api/task/edit/([0-9]*)', function ($id) {
    header('Content-Type: application/json');

    $taskController = new TaskController();
    $data = json_decode(file_get_contents('php://input'), true);

    if ($taskController->editTask($id, $data)) {
        echo json_encode(["message" => "Task updated successfully"]);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Failed to update task"]);
    }
}, ['post']);

Route::add('/api/task/complete/([0-9]*)', function ($id) {
    header('Content-Type: application/json');

    $taskController = new TaskController();
    $userController = new UserController();

    $userController->rewardUser();
    if ($taskController->completeTask($id)) {
        echo json_encode(["message" => "Task marked as complete"]);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Failed to complete task"]);
    }
}, ['put']);
