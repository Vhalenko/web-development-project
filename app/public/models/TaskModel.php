<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . "/../dto/TaskDto.php");
require_once(__DIR__ . "/../dto/UserDto.php");

class TaskModel extends BaseModel {

    public function addTask(int $userId, string $title, string $description, string $priotiry, DateTime $deadline, DateTime $creationDate, ?DateTime $completionDate, bool $isCompleted) :bool {
        $query = "INSERT INTO task (user_id, title, description, priority, deadline, creation_date, completion_date, is_completed)
            VALUES (:user_id, :title, :description, :priority, :deadline, :creation_date, :completion_date, :is_completed)";
        $stmt = $this->pdo->prepare($query);

        $deadlineStr = $deadline->format('Y-m-d');
        $creationDateStr = $creationDate->format('Y-m-d');
        $isCompletedInt = $this->boolToTinyint($isCompleted);
        
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priotiry);
        $stmt->bindParam(':deadline', $deadlineStr);
        $stmt->bindParam(':creation_date', $creationDateStr);
        $stmt->bindParam(':completion_date', $completionDate);
        $stmt->bindParam(':is_completed', $isCompletedInt);

        try {
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function completeTask(int $taskId) {
        $query = "UPDATE task SET completion_date = :completion_date, is_completed = :is_completed WHERE task_id = :task_id";
        $stmt = $this->pdo->prepare($query);

        $isCompleted = $this->boolToTinyint(true);
        $completionDate = new DateTime('now')->format('Y-m-d');

        $stmt->bindParam(':task_id', $taskId);
        $stmt->bindParam(':completion_date', $completionDate);
        $stmt->bindParam(':is_completed', $isCompleted);

        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function removeTask(int $taskId) {
        $query = "DELETE FROM task WHERE task_id = :task_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':task_id', $taskId);
        
        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function editTask(int $taskId, string $title, ?string $description, string $priority, DateTime $deadline) {
        $query = "UPDATE task SET title = :title, priority = :priority, deadline = :deadline, ";
    
        $params = [
            ':title' => $title,
            ':priority' => $priority,
            ':deadline' => $deadline->format('Y-m-d'),
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
    
        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function getTasksForUser(int $userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $taskDtos = [];

        foreach($tasks as $task) {
            $priority = Priority::from($task['priority']);
            $deadline = new DateTime($task['deadline']);
            $creationDate = new DateTime($task['creation_date']);
            $completionDate = $task['completion_date'] ? new DateTime($task['completion_date']) : null;
            $isCompleted = $this->tinyintToBool($task['is_completed']);

            $taskDTO = new TaskDto(
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

            $taskDtos[] = $taskDTO;
        }

        return $taskDtos; 
    }

    // public function getCompletedTasksForUser(int $userId) {
    //     $stmt = $this->pdo->prepare("SELECT * FROM task WHERE user_id = :user_id AND is_completed = 1");
    //     $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    //     $stmt->execute();

    //     $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     $taskDtos = [];

    //     foreach($tasks as $task) {
    //         $priority = Priority::from($task['priority']);
    //         $deadline = new DateTime($task['deadline']);
    //         $creationDate = new DateTime($task['creation_date']);
    //         $completionDate = $task['completion_date'] ? new DateTime($task['completion_date']) : null;
    //         $isCompleted = $this->tinyintToBool($task['is_completed']);

    //         $taskDTO = new TaskDto(
    //             $task['task_id'],
    //             $task['user_id'],
    //             $task['title'],
    //             $task['description'],
    //             $priority,
    //             $deadline,
    //             $creationDate,
    //             $completionDate,
    //             $isCompleted,
    //         );

    //         $taskDtos[] = $taskDTO;
    //     }

    //     return $taskDtos; 
    // }

    public function getTask(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE task_id = :task_id");
        $stmt->bindParam(':task_id', $id);
        $stmt->execute();

        $task = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return new TaskDto(
            $task['task_id'],
            $task['user_id'],
            $task['title'],
            $task['description'],
            $task['priority'],
            $task['deadline'],
            $task['creation_date'],
            $task['completion_date'],
            $task['is_completed'],
            $task['streak_contribution']
        );
    }

    private function boolToTinyint(bool $value) :int {
        if ($value) {
            return 1;
        }
        return 0;
    }

    private function tinyintToBool(int $value) :bool {
        return $value === 1;
    }
}