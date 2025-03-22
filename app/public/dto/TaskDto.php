<?php

class TaskDto implements JsonSerializable {
    private int $taskId;
    private int $userId;
    private string $title;
    private string $description;
    private Priority $priority;
    private DateTime $deadline;
    private DateTime $creationDate;
    private ?DateTime $completionDate;
    private bool $isCompleted;

    public function __construct(int $taskId, int $userId, string $title, string $description, Priority $priority, DateTime $deadline, DateTime $creationDate, ?DateTime $completionDate, bool $isCompleted) {
        $this->taskId = $taskId;
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
        $this->priority = $priority;
        $this->deadline = $deadline;
        $this->creationDate = $creationDate;
        $this->completionDate = $completionDate;
        $this->isCompleted = $isCompleted;
    }

    public function jsonSerialize(): mixed {
        return [
            'taskId' => $this->taskId,
            'userId' => $this->userId,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'deadline' => $this->deadline,
            'creationDate' => $this->creationDate,
            'completionDate' => $this->completionDate,
            'completed' => $this->isCompleted
        ];
    }

    // Getters and Setters
    public function getTaskId() :int {
        return $this->taskId;
    }
    public function setTaskId(int $taskId) {
        $this->taskId = $taskId;
    }

    public function getUserId() :int {
        return $this->userId;
    }
    public function setUserId(int $userId) {
        $this->userId = $userId;
    }

    public function getTitle() :string {
        return $this->title;
    }
    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function getDescription() :string{
        return $this->description;
    }
    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function getPriority() :Priority {
        return $this->priority;
    }
    public function setPriority(Priority $priority) {
        $this->priority = $priority;
    }

    public function getDeadline() :DateTime {
        return $this->deadline;
    }
    public function setDeadline(DateTime $deadline) {
        $this->deadline = $deadline;
    }

    public function getCreationDate() :DateTime {
        return $this->creationDate;
    }
    public function setCreationDate(DateTime $creationDate) {
        $this->creationDate = $creationDate;
    }

    public function getCompletionDate() :DateTime {
        return $this->completionDate;
    }
    public function setCompletionDate(DateTime $completionDate) {
        $this->completionDate = $completionDate;
    }

    public function getIsCompleted() :bool {
        return $this->isCompleted;
    }
    public function setIsCompleted(bool $isCompleted) {
        $this->isCompleted = $isCompleted;
    }
}

enum Priority: string {
    case High = 'high';
    case Medium = 'medium';
    case Low = 'low';
}