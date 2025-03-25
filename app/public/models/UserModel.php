<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . "/../dto/UserDto.php");

class UserModel extends BaseModel
{
    public function getUsersByPoints(): array
    {
        $query = "SELECT * FROM user ORDER BY total_tasks_completed DESC LIMIT 50";
        $stmt = $this->pdo->prepare($query);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return [];
        }

        $topUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        foreach ($topUsers as $topUser) {
            $lastCompletedTask = isset($topUser['last_completed_task']) && !empty($topUser['last_completed_task']) ? new DateTime($topUser['last_completed_task']) : null;

            $users[] = new UserDto(
                $topUser['user_id'],
                $topUser['username'],
                $topUser['full_name'],
                $topUser['email'],
                $topUser['streak_count'],
                $topUser['total_tasks_completed'],
                $topUser['total_points'],
                $lastCompletedTask,
                $topUser['selected_avatar']
            );
        }

        return $users;
    }


    public function addUser(string $username, ?string $fullName, string $email, string $password, int $streakCount, int $totalTasksCompleted, int $totalPoints, ?string $lastCompletedTask): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user (username, full_name, email, password_hash, streak_count, total_points, total_tasks_completed, last_completed_task)
                  VALUES (:username, :full_name, :email, :password_hash, :streak_count, :total_points, :total_tasks_completed, :last_completed_task)";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':full_name', $fullName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $hashedPassword);
        $stmt->bindParam(':streak_count', $streakCount);
        $stmt->bindParam(':total_points', $totalPoints);
        $stmt->bindParam(':total_tasks_completed', $totalTasksCompleted);
        $stmt->bindParam(':last_completed_task', $lastCompletedTask);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return false;
        }

        return true;
    }


    public function getUser(string $email, string $password): ?UserDto
    {
        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return null;
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $lastCompletedTask = isset($user['last_completed_task']) && !empty($user['last_completed_task']) ? new DateTime($user['last_completed_task']) : null;
            return new UserDto(
                $user['user_id'],
                $user['username'],
                $user['full_name'],
                $user['email'],
                $user['streak_count'],
                $user['total_tasks_completed'],
                $user['total_points'],
                $lastCompletedTask,
                $user['selected_avatar']
            );
        }
        return null;
    }

    public function editUser(int $id, ?string $username, ?string $fullName, ?string $email, ?string $password, ?string $selectedAvatar, ?int $totalPoints): bool
    {
        $fields = [];
        $params = [':user_id' => $id];

        $updates = [
            'username' => $username,
            'full_name' => $fullName,
            'email' => $email,
            'password_hash' => $password ? password_hash($password, PASSWORD_DEFAULT) : null,
            'selected_avatar' => $selectedAvatar,
            'total_points' => $totalPoints
        ];

        foreach ($updates as $column => $value) {
            if ($value !== null) {
                $fields[] = "$column = :$column";
                $params[":$column"] = $value;
            }
        }

        if (empty($fields)) {
            return false;
        }

        $query = "UPDATE user SET " . implode(', ', $fields) . " WHERE user_id = :user_id";

        $stmt = $this->pdo->prepare($query);

        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value);
        }

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return false;
        }

        return true;
    }

    public function emailExists($email): bool
    {
        $query = "SELECT COUNT(*) FROM user WHERE email = :email";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':email', $email);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return false;
        }

        return $stmt->fetchColumn();
    }

    public function getUserById($userId): ?UserDTO
    {
        $query = "SELECT * FROM user WHERE user_id = :userId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return null;
        }
        $user = $stmt->fetch();

        if ($user) {
            $lastCompletedTask = isset($user['last_completed_task']) && !empty($user['last_completed_task']) ? new DateTime($user['last_completed_task']) : null;
            return new UserDto(
                $user['user_id'],
                $user['username'],
                $user['full_name'],
                $user['email'],
                $user['streak_count'],
                $user['total_tasks_completed'],
                $user['total_points'],
                $lastCompletedTask,
                $user['selected_avatar']
            );
        }
        return null;
    }

    public function rewardUser(int $userId, int $streakCount, int $totalPoints, int $totalTasksCompleted, string $lastCompletedTask): bool
    {
        $query = "UPDATE user SET streak_count = :streak_count, total_points = :total_points, total_tasks_completed = :total_tasks_completed, last_completed_task = :last_completed_task WHERE user_id = :user_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':streak_count', $streakCount);
        $stmt->bindParam(':total_points', $totalPoints);
        $stmt->bindParam(':total_tasks_completed', $totalTasksCompleted);
        $stmt->bindParam(':last_completed_task', $lastCompletedTaskStr);
        $stmt->bindParam(':user_id', $userId);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return false;
        }

        return true;
    }
}
