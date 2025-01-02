<?php

require_once(__DIR__ . "/BaseModel.php");

class UserModel extends BaseModel {
    protected static $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUsersByPoints() {
        $stmt = $this->pdo->prepare("SELECT * FROM user ORDER BY total_points DESC LIMIT 50");
        $stmt->execute();

        $topUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $topUsers; 
    }

    public function addUser($user) {
        $stmt = $this->pdo->prepare("
            INSERT INTO user (username, email, password_hash, profile_picture, date_joined, last_login, achievements, streak_count, total_tasks_completed, role)
            VALUES (:username, :email, :password_hash, :profile_picture, :date_joined, :last_login, :achievements, :streak_count, :total_tasks_completed, :role)
        ");
        
        $stmt->execute([
            ':username' => $user['username'],
            ':email' => $user['email'],
            ':password_hash' => $user['password_hash'],
            ':profile_picture' => $user['profile_picture'],
            ':date_joined' => $user['date_joined'],
            ':last_login' => $user['last_login'],
            ':achievements' => $user['achievements'],
            ':streak_count' => $user['streak_count'],
            ':total_tasks_completed' => $user['total_tasks_completed'],
            ':role' => $user['role']
        ]);
    }
    

    public function getUser($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user; 
        } else {
            return null; 
        }
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
                role = :role
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
            ':role' => $user['role']
        ]);
    }
    
}
