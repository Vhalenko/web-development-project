<?php

class UserDto {
    private int $userId;
    private string $username;
    private string $email;
    private int $streakCount;
    private int $totalTasksCompleted;

    public function __construct(int $userId, string $username, string $email, int $streakCount, int $totalTasksCompleted) {
        $this->userId = $userId;
        $this->username = $username;
        $this->email = $email;
        $this->streakCount = $streakCount;
        $this->totalTasksCompleted = $totalTasksCompleted;
    }

    // Getters and Setters
    public function getUserId() :int {
        return $this->userId;
    }
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getUsername() :string {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() :string {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getStreakCount() :int {
        return $this->streakCount;
    }
    public function setStreakCount($streakCount) {
        $this->streakCount = $streakCount;
    }

    public function getTotalTasksCompleted() :int {
        return $this->totalTasksCompleted;
    }
    public function setTotalTasksCompleted($totalTasksCompleted) {
        $this->totalTasksCompleted = $totalTasksCompleted;
    }
}