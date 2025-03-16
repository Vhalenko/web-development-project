<?php

class UserDto {
    private int $userId;
    private string $username;
    private ?string $fullName;
    private string $email;
    private int $streakCount;
    private int $totalTasksCompleted;
    private int $totalPoints;
    private ?DateTime $lastCompletedTask;

    public function __construct(int $userId, string $username, ?string $fullName, string $email, int $streakCount, int $totalTasksCompleted, int $totalPoints, ?DateTime $lastCompletedTask) {
        $this->userId = $userId;
        $this->username = $username;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->streakCount = $streakCount;
        $this->totalTasksCompleted = $totalTasksCompleted;
        $this->totalPoints = $totalPoints;
        $this->lastCompletedTask = $lastCompletedTask;
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

    public function getFullName() :string {
        return $this->fullName;
    }
    public function setFullName($fullName) {
        $this->fullName = $fullName;
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

    public function getTotalPoints() :int {
        return $this->totalPoints;
    }
    public function setTotalPoints($totalPoints) {
        $this->totalPoints = $totalPoints;
    }

    public function getLastCompletedTask() :?DateTime {
        return $this->lastCompletedTask;
    }
    public function setLastCompletedTask($lastCompletedTask) {
        $this->lastCompletedTask = $lastCompletedTask;
    }
}