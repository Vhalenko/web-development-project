<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . "/../dto/UserDto.php");

class UserModel extends BaseModel
{
    public function getUsersByPoints(): array
    {
        $query = "SELECT * FROM user ORDER BY streak_count DESC LIMIT 50";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

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
                $topUser['total_points'] ,
                $lastCompletedTask,
                $topUser['selected_avatar']        
            );
        }

        return $users;
    }


    public function addUser(string $username, ?string $fullName, string $email, string $password, int $streakCount, int $totalTasksCompleted, int $totalPoints, ?DateTime $lastCompletedTask): ?bool
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

        try {
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function getUser(string $email, string $password): ?UserDto
    {
        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            try {
                $lastCompletedTask = new DateTime($user['last_completed_task']);
                return new UserDto(
                    $user['user_id'],              
                    $user['username'],   
                    $user['full_name'],                
                    $user['email'],                       
                    $user['streak_count'],          
                    $user['total_tasks_completed'], 
                    $user['total_points'] ,
                    $lastCompletedTask,
                    $user['selected_avatar']          
                );
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        return null;
    }


    public function editUser(int $id, ?string $username, ?string $fullName, ?string $email, ?string $password, ?string $selectedAvatar, ?int $totalPoints): bool
    {
        $query = "UPDATE user SET ";
        $params = [];

        if ($username !== null) {
            $query .= "username = :username, ";
            $params[':username'] = $username;
        }
        if ($fullName !== null) {
            $query .= "full_name = :full_name, ";
            $params[':full_name'] = $fullName;
        }
        if ($email !== null) {
            $query .= "email = :email, ";
            $params[':email'] = $email;
        }
        if ($password !== null) {
            $query .= "password_hash = :password, ";
            $params[':password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        if ($selectedAvatar !== null) {
            $query .= "selected_avatar = :selected_avatar, ";
            $params[':selected_avatar'] = $selectedAvatar;
        }
        if ($totalPoints !== null) {
            $query .= "total_points = :total_points, ";
            $params[':total_points'] = $totalPoints;
        }

        $query = rtrim($query, ', ');

        $query .= " WHERE user_id = :user_id";
        $params[':user_id'] = $id;

        $stmt = $this->pdo->prepare($query);

        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value);
        }

        try {
            return $stmt->execute($params);
        } catch (Exception $e) {
            echo "Error clearing reset token: " . $e->getMessage();
            return false;
        }
    }

    public function emailExists($email): bool
    {
        $query = "SELECT COUNT(*) FROM user WHERE email = :email";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':email', $email);

        try {
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getUserById($userId): ?UserDTO
    {
        $query = "SELECT * FROM user WHERE user_id = :userId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId);

        try {
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user) {
                $lastCompletedTask = new DateTime($user['last_completed_task']);
                return new UserDto(
                    $user['user_id'],              
                    $user['username'],   
                    $user['full_name'],                
                    $user['email'],                       
                    $user['streak_count'],          
                    $user['total_tasks_completed'], 
                    $user['total_points'] ,
                    $lastCompletedTask,
                    $user['selected_avatar']          
                );
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return null;
    }

    public function rewardUser(int $userId, int $streakCount, int $totalPoints, int $totalTasksCompleted, DateTime $lastCompletedTask): ?bool {
        $query = "UPDATE user SET streak_count = :streak_count, total_points = :total_points, total_tasks_completed = :total_tasks_completed, last_completed_task = :last_completed_task WHERE user_id = :user_id";

        $lastCompletedTaskStr = $lastCompletedTask->format('Y-m-d');
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':streak_count', $streakCount);
        $stmt->bindParam(':total_points', $totalPoints);
        $stmt->bindParam(':total_tasks_completed', $totalTasksCompleted);
        $stmt->bindParam(':last_completed_task', $lastCompletedTaskStr);
        $stmt->bindParam(':user_id', $userId);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error clearing reset token: " . $e->getMessage();
            return false;
        }
    }
}
