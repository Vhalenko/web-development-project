<?php

class TaskDto {
    private $taskId;
    private $userId;
    private $title;
    private $description;
    private $categoryId;
    private $priority;
    private $deadline;
    private $creationDate;
    private $completionDate;
    private $isCompleted;
    private $streakContribution;

    public function __construct($taskId, $userId, $title, $categoryId, $priority, $creationDate, $isCompleted = false, $description = null, $deadline = null, $completionDate = null, $streakContribution = false) {
        $this->taskId = $taskId;
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
        $this->categoryId = $categoryId;
        $this->priority = $priority;
        $this->deadline = $deadline;
        $this->creationDate = $creationDate;
        $this->completionDate = $completionDate;
        $this->isCompleted = $isCompleted;
        $this->streakContribution = $streakContribution;
    }

    // Getters and Setters
    public function getTaskId() {
        return $this->taskId;
    }
    public function setTaskId($taskId) {
        $this->taskId = $taskId;
    }

    public function getUserId() {
        return $this->userId;
    }
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDescription() {
        return $this->description;
    }
    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }
    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    public function getPriority() {
        return $this->priority;
    }
    public function setPriority($priority) {
        $this->priority = $priority;
    }

    public function getDeadline() {
        return $this->deadline;
    }
    public function setDeadline($deadline) {
        $this->deadline = $deadline;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function getCompletionDate() {
        return $this->completionDate;
    }
    public function setCompletionDate($completionDate) {
        $this->completionDate = $completionDate;
    }

    public function getIsCompleted() {
        return $this->isCompleted;
    }
    public function setIsCompleted($isCompleted) {
        $this->isCompleted = $isCompleted;
    }

    public function getStreakContribution() {
        return $this->streakContribution;
    }
    public function setStreakContribution($streakContribution) {
        $this->streakContribution = $streakContribution;
    }
}

