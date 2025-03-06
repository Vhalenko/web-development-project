<?php

class UserDto {
    private $userId;
    private $username;
    private $email;
    private $password;
    private $streakCount;
    private $totalTasksCompleted;

    public function __construct($userId, $username, $email, $streakCount, $totalTasksCompleted) {
        $this->$userId = $userId;
        $this->username = $username;
        $this->email = $email;
        $this->streakCount = $streakCount;
        $this->totalTasksCompleted = $totalTasksCompleted;
    }

    // Getters and Setters
    public function getUserId() {
        return $this->userId;
    }
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($passwordHash) {
        $this->password = $passwordHash;
    }

    public function getStreakCount() {
        return $this->streakCount;
    }
    public function setStreakCount($streakCount) {
        $this->streakCount = $streakCount;
    }

    public function getTotalTasksCompleted() {
        return $this->totalTasksCompleted;
    }
    public function setTotalTasksCompleted($totalTasksCompleted) {
        $this->totalTasksCompleted = $totalTasksCompleted;
    }
}