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
                header("Location: /profile");
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

    public function editUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = ($_POST['username']);
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (empty($password)) {
                $password = null;
            }
            $userId = $_SESSION['user']['id'];

            if ($this->userModel->editUser($userId, $username, $email, $password)) {
                try {
                    $this->updateSession($userId);
                    header("Location: /profile");
                    return true;
                } catch (Exception $e) {
                    echo "Error sending email: {$e}";
                }
            } else {
                echo "Error updating profile";
            }
        }
        return false;
    }

    private function updateSession(int $userId) {
        $userDTO = $this->userModel->getUserById($userId);
        if (!is_null($userDTO)) {            
            $_SESSION['user'] = [
                'id' => $userDTO->getUserId(),
                'username' => $userDTO->getUsername(),
                'email' => $userDTO->getEmail(),
                'streak_count' => $userDTO->getStreakCount(),
                'total_tasks_completed' => $userDTO->getTotalTasksCompleted()
            ];
        }
        else {
            echo "Error updating a session";
        }
    }
}
