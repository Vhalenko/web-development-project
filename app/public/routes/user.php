<?php
require_once(__DIR__ . "../../controllers/UserController.php");

// $userController = new UserController();

// Route::add('/users', function () {
//     $userController = new UserController(); 
//     $users = $userController->getUsersByPoints(); 
//     require_once(__DIR__ . "/../views/pages/users.php"); 
// });

// // Route::add('/user/([a-z-0-9-]*)', function ($userId) use ($userController) {
// //     $user = $userController->get($userId); // get data for the view
// //     require_once(__DIR__ . "/../views/pages/user.php"); // load the view
// // });

// Route::add("/api/users/login", function () use ($userController) {
//     $data = json_decode(file_get_contents("php://input"), true);

//     if (!isset($data['username']) || !isset($data['password'])) {
//         http_response_code(400); // Bad Request
//         echo json_encode(["error" => "Username and password are required"]);
//         return;
//     }

//     $username = $data['username'];
//     $password = $data['password'];

//     $result = $userController->getUser($username, $password);

//     if ($result) {
//         echo json_encode($result);
//     } else {
//         http_response_code(401); // Unauthorized
//         echo json_encode(["error" => "Invalid credentials"]);
//     }
// });

// Route::add("/api/users", function () use ($userController) {
//     $data = json_decode(file_get_contents("php://input"), true);

//     $username = $data['username'];
//     $email = $data['email'];
//     $password = password_hash($data['password'], PASSWORD_DEFAULT);

//     $result = $userController->createUser($username, $email, $password);

    
// }, 'post');

Route::add('/login', function () {
    if (!isset($_SESSION['user'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userController = new UserController();
        $userController->login();
        exit;
    }
    require_once(__DIR__ . "/../views/pages/login.php");
}

}, ['get', 'post']);

Route::add('/logout', function () {
    if (isset($_SESSION['user'])) {
        $userController = new UserController();
        $userController->logout();
        exit;
    }
});

Route::add('/signup', function () {
    if (!isset($_SESSION['user'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userController = new UserController();
        $userController->signUp();
        exit;
    }
    require_once(__DIR__ . "/../views/pages/login.php");
}

}, ['get', 'post']);