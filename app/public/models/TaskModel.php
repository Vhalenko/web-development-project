<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . "/../dto/TaskDto.php");
require_once(__DIR__ . "/../dto/UserDto.php");

class TaskModel extends BaseModel {

    public function addTask(int $userId, string $title, string $description, Priotiry $priotiry, DateTime $deadline, DateTime $creationDate, ?DateTime $completionDate, bool $isCompleted) {
        $query = "INSERT INTO task (user_id, title, description, priority, deadline, creation_date, completion_date, is_completed, streak_contribution)
            VALUES (:user_id, :title, :description, :priority, :deadline, :creation_date, :completion_date, :is_completed, :streak_contribution)";
        $stmt = self::$pdo->prepare($query);
        
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', strval($priotiry));
        $stmt->bindParam(':deadline', $deadline);
        $stmt->bindParam(':creation_date', $creationDate);
        $stmt->bindParam(':completion_date', $completionDate);
        $stmt->bindParam(':is_completed', $isCompleted);

        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function completeTask(int $id) {
        $query = "UPDATE task SET completion_date = :completion_date, is_completed = :is_completed WHERE task_id = :task_id";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':task_id', $id);
        $stmt->bindParam(':completion_date', new DateTime('now'));
        $stmt->bindParam(':is_completed', true);

        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function removeTask(TaskDto $task) {
        $query = "DELETE FROM task WHERE task_id = :task_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':task_id', $task->getTaskId());
        
        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function editTask($task) {
        $query = "UPDATE task
            SET user_id = :user_id,
                title = :title,
                description = :description,
                category = :category,
                priority = :priority,
                deadline = :deadline,
                creation_date = :creation_date,
                completion_date = :completion_date,
                is_completed = :is_completed,
                streak_contribution = :streak_contribution
            WHERE task_id = :task_id";

        $stmt = self::$pdo->prepare($query);
        
        $stmt->bindParam(':task_id', $task->getTaskId());
        $stmt->bindParam(':user_id', $task->getUserId());
        $stmt->bindParam(':title', $task->getTitle());
        $stmt->bindParam(':description', $task->getDescription());
        $stmt->bindParam(':priority', $task->getPriority());
        $stmt->bindParam(':deadline', $task->getDeadline());
        $stmt->bindParam(':creation_date', $task->getCreationDate());
        $stmt->bindParam(':completion_date', $task->getCompletionDate());
        $stmt->bindParam(':is_completed', $task->getIsCompleted());
        $stmt->bindParam(':streak_contribution', $task->getStreakContribution());

        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getTasksForUser(UserDto $user) {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user->getUserId(), PDO::PARAM_INT);
        $stmt->execute();

        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $taskDtos = [];

        foreach($tasks as $task) {
            $taskDTO = new TaskDto(
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

            $taskDtos[] = $taskDTO;
        }

        return $taskDtos; 
    }

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
}