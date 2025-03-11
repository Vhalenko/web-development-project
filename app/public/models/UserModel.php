<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . "/../dto/UserDto.php");

class UserModel extends BaseModel
{
    public function getUsersByPoints()
    {
        $query = "SELECT * FROM user ORDER BY total_points DESC LIMIT 50";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();

        $topUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $topUsers;
    }

    public function addUser(string $username, string $email, string $password, int $streakCount, int $totalTasksCompleted): ?bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user (username, email, password_hash, streak_count, total_tasks_completed)
                  VALUES (:username, :email, :password_hash, :streak_count, :total_tasks_completed)";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $hashedPassword);
        $stmt->bindParam(':streak_count', $streakCount);
        $stmt->bindParam(':total_tasks_completed', $totalTasksCompleted);

        try {
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function getUser(string $email, string $password): ?UserDto {
        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['password_hash'])) {
            try {
                return new UserDto(
                    $user['user_id'],
                    $user['username'],
                    $user['email'],
                    $user['streak_count'],
                    $user['total_tasks_completed']
                );
            }
            catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        return null;
    }
    

    public function editUser(UserDto $user)
    {
        $query = "UPDATE user
            SET username = :username,
                email = :email,
                password_hash = :password_hash,
                streak_count = :streak_count,
                total_tasks_completed = :total_tasks_completed,
            WHERE user_id = :user_id";

        $stmt = self::$pdo->prepare($query);

        $stmt->bindParam(':username', $user->getUsername());
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->bindParam(':streak_count', $user->getStreakCount());
        $stmt->bindParam(':total_tasks_completed', $user->getTotalTasksCompleted());

        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
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
}
