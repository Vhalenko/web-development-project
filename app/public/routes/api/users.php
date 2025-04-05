<?php

require_once(__DIR__ . '/../../controllers/UserController.php');

Route::add('/api/user/points', function () {
    header('Content-Type: application/json');

    if (!isset($_SESSION['user']['id'])) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized"]);
        return;
    }

    $userController = new UserController();
    $user = $userController->getUserById($_SESSION['user']['id']);

    echo json_encode(["totalPoints" => $user->getTotalPoints()]);
});