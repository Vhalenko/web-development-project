<?php

require_once(__DIR__ . "/BaseModel.php");

class UserModel extends BaseModel {
    protected static $pdo;

    public function __construct() {
    }

    public function getUsersByPoints() {
        $query = "SELECT * FROM user ORDER BY total_points DESC LIMIT 50";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();

        $topUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $topUsers; 
    }

    public function addUser(string $username, string $email, string $password, int $streakCount, int $totalTasksCompleted) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user (username, email, password_hash, streak_count, total_tasks_completed)
                  VALUES (:username, :email, :password_hash, :streak_count, :total_tasks_completed)";
        
        $stmt = self::$pdo->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $hashedPassword);
        $stmt->bindParam(':streak_count', $streakCount);
        $stmt->bindParam(':total_tasks_completed', $totalTasksCompleted);

        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function getUser(string $username, string $password): ?UserDto {
        $query = "SELECT * FROM user WHERE username = :username";
        $stmt = self::$pdo->prepare($query);
        $stmt->bindParam(':username', $username);

        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password_hash'])) {
                return new UserDto(
                    $user['user_id'],
                    $user['username'],
                    $user['email'],
                    $user['streak_count'],
                    $user['total_tasks_completed']
                );
            }
        }
        return null;
    }

    public function editUser($user) {
        $stmt = $this->pdo->prepare("
            UPDATE user
            SET username = :username,
                email = :email,
                password_hash = :password_hash,
                profile_picture = :profile_picture,
                date_joined = :date_joined,
                last_login = :last_login,
                achievements = :achievements,
                streak_count = :streak_count,
                total_tasks_completed = :total_tasks_completed,
            WHERE user_id = :user_id
        ");
        
        $stmt->execute([
            ':user_id' => $user['user_id'],
            ':username' => $user['username'],
            ':email' => $user['email'],
            ':password_hash' => $user['password_hash'],
            ':profile_picture' => $user['profile_picture'],
            ':date_joined' => $user['date_joined'],
            ':last_login' => $user['last_login'],
            ':achievements' => $user['achievements'],
            ':streak_count' => $user['streak_count'],
            ':total_tasks_completed' => $user['total_tasks_completed'],
        ]);
    }

    public function emailExists($email) {
        $query = "SELECT COUNT(*) FROM Users WHERE email = :email";
        $stmt = self::$pdo->prepare($query);
        
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
