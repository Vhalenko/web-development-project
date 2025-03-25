<?php

class UserDto
{
    private const DEFAULT_AVATAR = 'default-profile.jpg';
    private int $userId;
    private string $username;
    private ?string $fullName;
    private string $email;
    private int $streakCount;
    private int $totalTasksCompleted;
    private int $totalPoints;
    private ?DateTime $lastCompletedTask;
    private ?string $selectedAvatar;

    public function __construct(int $userId, string $username, ?string $fullName, string $email, int $streakCount, int $totalTasksCompleted, int $totalPoints, ?DateTime $lastCompletedTask, ?string $selectedAvatar)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->streakCount = $streakCount;
        $this->totalTasksCompleted = $totalTasksCompleted;
        $this->totalPoints = $totalPoints;
        $this->lastCompletedTask = $lastCompletedTask;
        $this->selectedAvatar = $selectedAvatar;
    }

    // Getters
    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStreakCount(): int
    {
        return $this->streakCount;
    }

    public function getTotalTasksCompleted(): int
    {
        return $this->totalTasksCompleted;
    }

    public function getTotalPoints(): int
    {
        return $this->totalPoints;
    }

    public function getLastCompletedTask(): ?DateTime
    {
        return $this->lastCompletedTask;
    }

    public function getSelectedAvatar(): ?string
    {
        return $this->selectedAvatar ?: self::DEFAULT_AVATAR;
    }

    // Setters
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setStreakCount(int $streakCount): void
    {
        $this->streakCount = $streakCount;
    }

    public function setTotalTasksCompleted(int $totalTasksCompleted): void
    {
        $this->totalTasksCompleted = $totalTasksCompleted;
    }

    public function setTotalPoints(int $totalPoints): void
    {
        $this->totalPoints = $totalPoints;
    }

    public function setLastCompletedTask(?DateTime $lastCompletedTask): void
    {
        $this->lastCompletedTask = $lastCompletedTask;
    }

    public function setSelectedAvatar(string $selectedAvatar): void
    {
        $this->selectedAvatar = $selectedAvatar;
    }
}
