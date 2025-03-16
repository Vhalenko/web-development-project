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

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userDTO = $this->userModel->getUser($email, $password);

            if (!is_null($userDTO)) {
                $_SESSION['user'] = [
                    'id' => $userDTO->getUserId(),
                    'username' => $userDTO->getUsername(),
                    'fullName' => $userDTO->getFullName(),
                    'email' => $userDTO->getEmail(),
                    'streak_count' => $userDTO->getStreakCount(),
                    'total_tasks_completed' => $userDTO->getTotalTasksCompleted(),
                    'last_completed_task' => $userDTO->getLastCompletedTask(),
                    'total_points' => $userDTO->getTotalPoints(),
                    'selected_avatar' => $userDTO->getSelectedAvatar()
                ];
                header("Location: /profile");
            } else {
                echo "<script>alert('login failed');</script>";
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /");
        exit;
    }

    public function signUp()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $fullName = htmlspecialchars($_POST['fullName']);
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];

            if ($this->userModel->emailExists($email)) {
                echo "Username or email already in use.";
                exit;
            }

            try {
                $this->userModel->addUser($username, $fullName, $email, $password, 0, 0, 0, null);
                header("Location: /login-page");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                exit;
            }
        }
    }

    public function getUsersByPoints(): array
    {
        return $this->userModel->getUsersByPoints();
    }

    public function editUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = ($_POST['username']);
            $fullName = ($_POST['fullName']);
            $email = $_POST['email'];
            $password = $_POST['password'];
            $selectedAvatar = $_POST['selected_avatar'];
            if (empty($password)) {
                $password = null;
            }
            $userId = $_SESSION['user']['id'];

            if ($this->userModel->editUser($userId, $username, $fullName, $email, $password, $selectedAvatar, null)) {
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

    private function updateSession(int $userId)
    {
        $userDTO = $this->userModel->getUserById($userId);
        if (!is_null($userDTO)) {
            $_SESSION['user'] = [
                'id' => $userDTO->getUserId(),
                'username' => $userDTO->getUsername(),
                'fullName' => $userDTO->getFullName(),
                'email' => $userDTO->getEmail(),
                'streak_count' => $userDTO->getStreakCount(),
                'total_tasks_completed' => $userDTO->getTotalTasksCompleted(),
                'last_completed_task' => $userDTO->getLastCompletedTask(),
                'total_points' => $userDTO->getTotalPoints(),
                'selected_avatar' => $userDTO->getSelectedAvatar()
            ];
        } else {
            echo "Error updating a session";
        }
    }

    public function rewardUser() {
        $user = $this->getUserById($_SESSION['user']['id']);
        $streak = $user->getStreakCount();
        $points = $user->getTotalPoints();
        $totalTasksCompleted = $user->getTotalTasksCompleted();
        $lastCompletedTask = $user->getLastCompletedTask();
        
        $points = $points + 10;
        $totalTasksCompleted += 1;
        if ($lastCompletedTask->format('Y-m-d') != (new DateTime('today'))->format('Y-m-d')) {
            if ($lastCompletedTask->format('Y-m-d') === (new DateTime('today'))->modify('-1 day')->format('Y-m-d')) {
                $streak = $streak + 1;
            } else {
                $streak = 0;
            }
        }
        $lastCompletedTask = new DateTime('now');

        $this->userModel->rewardUser($user->getUserId(), $streak, $points, $totalTasksCompleted, $lastCompletedTask);

        $this->updateSession($user->getUserId());
    }

    public function getUserById(int $id) :UserDto {
        return $this->userModel->getUserById($id);
    }
}
