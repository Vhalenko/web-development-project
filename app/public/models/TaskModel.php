<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . "/../dto/TaskDto.php");
require_once(__DIR__ . "/../dto/UserDto.php");

class TaskModel extends BaseModel
{

    public function addTask(int $userId, string $title, string $description, string $priotiry, string $deadline, string $creationDate, ?string $completionDate, int $isCompleted): bool
    {
        $query = "INSERT INTO task (user_id, title, description, priority, deadline, creation_date, completion_date, is_completed)
            VALUES (:user_id, :title, :description, :priority, :deadline, :creation_date, :completion_date, :is_completed)";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priotiry);
        $stmt->bindParam(':deadline', $deadline);
        $stmt->bindParam(':creation_date', $creationDate);
        $stmt->bindParam(':completion_date', $completionDate);
        $stmt->bindParam(':is_completed', $isCompleted);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return false;
        }

        return true;
    }

    public function completeTask(int $taskId, int $isCompleted, string $completionDate): bool
    {
        $query = "UPDATE task SET completion_date = :completion_date, is_completed = :is_completed WHERE task_id = :task_id";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':task_id', $taskId);
        $stmt->bindParam(':completion_date', $completionDate);
        $stmt->bindParam(':is_completed', $isCompleted);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return false;
        }

        return true;
    }

    public function removeTask(int $taskId): bool
    {
        $query = "DELETE FROM task WHERE task_id = :task_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':task_id', $taskId);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return false;
        }

        return true;
    }

    public function editTask(int $taskId, string $title, ?string $description, string $priority, string $deadline): bool
    {
        $query = "UPDATE task SET title = :title, priority = :priority, deadline = :deadline, ";

        $params = [
            ':title' => $title,
            ':priority' => $priority,
            ':deadline' => $deadline,
        ];

        if ($description !== null) {
            $query .= "description = :description";
            $params[':description'] = $description;
        }

        $query .= " WHERE task_id = :task_id";
        $params[':task_id'] = $taskId;

        $stmt = $this->pdo->prepare($query);

        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value);
        }

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return false;
        }

        return true;
    }


    public function getTasksForUser(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return [];
        }

        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $taskDtos = [];

        foreach ($tasks as $task) {
            $priority = Priority::from($task['priority']);
            $deadline = new DateTime($task['deadline']);
            $creationDate = new DateTime($task['creation_date']);
            $completionDate = $task['completion_date'] ? new DateTime($task['completion_date']) : null;
            $isCompleted = $this->tinyintToBool($task['is_completed']);

            $taskDto = new TaskDto(
                $task['task_id'],
                $task['user_id'],
                $task['title'],
                $task['description'],
                $priority,
                $deadline,
                $creationDate,
                $completionDate,
                $isCompleted,
            );

            $taskDtos[] = $taskDto;
        }

        return $taskDtos;
    }

    public function getTask(int $id): ?TaskDto
    {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE task_id = :task_id");
        $stmt->bindParam(':task_id', $id);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return null;
        }

        $task = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $priority = Priority::from($task['priority']);
        $deadline = new DateTime($task['deadline']);
        $creationDate = new DateTime($task['creation_date']);
        $completionDate = $task['completion_date'] ? new DateTime($task['completion_date']) : null;
        $isCompleted = $this->tinyintToBool($task['is_completed']);

        return new TaskDto(
            $task['task_id'],
            $task['user_id'],
            $task['title'],
            $task['description'],
            $priority,
            $deadline,
            $creationDate,
            $completionDate,
            $isCompleted,
        );
    }

    private function tinyintToBool(int $value): bool
    {
        return $value === 1;
    }
}
