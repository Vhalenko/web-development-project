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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userDTO = $this->userModel->getUser($email, $password);

            if (!is_null($userDTO)) {
                $_SESSION['user'] = [
                    'id' => $userDTO->getUserId(),
                    'username' => $userDTO->getUsername(),
                    'email' => $userDTO->getEmail(),
                    'streak_count' => $userDTO->getStreakCount(),
                    'total_tasks_completed' => $userDTO->getTotalTasksCompleted()
                ];
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];

            if ($this->userModel->emailExists($email)) {
                echo "Username or email already in use.";
                exit;
            }

            try {
                $this->userModel->addUser($username, $email, $password, 0, 0);
            }
            catch(Exception $e) {
                echo "Error: " . $e->getMessage();
                exit;
            }
        }
    }

    public function getUsersByPoints() {
        return $this->userModel->getUsersByPoints();
    }
}
