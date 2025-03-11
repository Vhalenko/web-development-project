<?php

class TaskModel extends BaseModel {
    public function addTask(TaskDto $task) {
        $query = "INSERT INTO task (user_id, title, description, priority, deadline, creation_date, completion_date, is_completed, streak_contribution)
            VALUES (:user_id, :title, :description, :priority, :deadline, :creation_date, :completion_date, :is_completed, :streak_contribution)";
        $stmt = self::$pdo->prepare($query);
        
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

    public function removeTask($task) {
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

    public function getTasksForUser($user) {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user->getUserId(), PDO::PARAM_INT);
        $stmt->execute();

        $topUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $topUsers; 
    }
}