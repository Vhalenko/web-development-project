<?php

require_once(__DIR__ . "../../models/UserModel.php");
require_once(__DIR__ . "../../dto/UserDto.php");

class UserController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
     
    public function login() {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = $_POST['password'];

            $userDTO = $this->userModel->getUser($username, $password);

            if ($userDTO) {
                $_SESSION['user'] = [
                    'id' => $userDTO->getUserId(),
                    'username' => $userDTO->getUsername(),
                    'email' => $userDTO->getEmail(),
                    'password' => $userDTO->getPassword(),
                    'streak_count' => $userDTO->getStreakCount(),
                    'total_tasks_completed' => $userDTO->getTotalTasksCompleted()
                ];
                header("Location: /");
                exit;
            } else {
                exit;
            }
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: /");
        exit;
    }

    public function signUp() {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];

            if ($this->userModel->emailExists($email)) {
                $errors[] = "Username or email already in use.";
                exit;
            }

            $userDTO = $this->userModel->addUser($username, $email, $password, 0, 0);

            if ($userDTO) {
                header("Location: /login");
            } else {
                echo "Error creating user.";
            }
        }
    }
}
