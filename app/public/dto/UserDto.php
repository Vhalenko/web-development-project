<?php

class UserDto {
    private $userId;
    private $username;
    private $email;
    private $passwordHash;
    private $profilePicture;
    private $dateJoined;
    private $lastLogin;
    private $achievements; 
    private $streakCount;
    private $totalTasksCompleted;
    private $role;

    public function __construct($userId, $username, $email, $passwordHash, $dateJoined, $role, $profilePicture = null, $achievements = [], $streakCount = 0, $totalTasksCompleted = 0, $lastLogin = null) {
        $this->userId = $userId;
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->profilePicture = $profilePicture;
        $this->dateJoined = $dateJoined;
        $this->lastLogin = $lastLogin;
        $this->achievements = $achievements;
        $this->streakCount = $streakCount;
        $this->totalTasksCompleted = $totalTasksCompleted;
        $this->role = $role;
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

    public function getPasswordHash() {
        return $this->passwordHash;
    }
    public function setPasswordHash($passwordHash) {
        $this->passwordHash = $passwordHash;
    }

    public function getProfilePicture() {
        return $this->profilePicture;
    }
    public function setProfilePicture($profilePicture) {
        $this->profilePicture = $profilePicture;
    }

    public function getDateJoined() {
        return $this->dateJoined;
    }
    public function setDateJoined($dateJoined) {
        $this->dateJoined = $dateJoined;
    }

    public function getLastLogin() {
        return $this->lastLogin;
    }
    public function setLastLogin($lastLogin) {
        $this->lastLogin = $lastLogin;
    }

    public function getAchievements() {
        return $this->achievements;
    }
    public function setAchievements($achievements) {
        $this->achievements = $achievements;
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

    public function getRole() {
        return $this->role;
    }
    public function setRole($role) {
        $this->role = $role;
    }
}