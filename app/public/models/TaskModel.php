<?php

class TaskModel extends BaseModel {
    protected static $pdo;

    public function __construct($pdo) {
        $this->$pdo = $pdo;
    }

    public function addTask($task) {
        $stmt = $this->pdo->prepare("
            INSERT INTO task (user_id, title, description, category, priority, deadline, creation_date, completion_date, is_completed, streak_contribution)
            VALUES (:user_id, :title, :description, :category, :priority, :deadline, :creation_date, :completion_date, :is_completed, :streak_contribution)
        ");
        
        $stmt->execute([
            ':task_id' => $task['task_id'],
            ':user_id' => $task['user_id'],
            ':title' => $task['title'],
            ':description' => $task['description'],
            ':category' => $task['category'],
            ':priority' => $task['priority'],
            ':deadline' => $task['deadline'],
            ':creation_date' => $task['creation_date'],
            ':completion_date' => $task['completion_date'],
            ':is_completed' => $task['is_completed'],
            ':streak_contribution' => $task['streak_contribution']
        ]);
    }

    public function removeTask($task) {
        $stmt = $this->pdo->prepare("DELETE FROM task WHERE task_id = :task_id");
        $stmt->bindParm(':task_id', $task->getTaskId(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function editTask($task) {
        $stmt = $this->pdo->prepare("
            UPDATE task
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
            WHERE task_id = :task_id
        ");
        
        $stmt->execute([
            ':task_id' => $task['task_id'],
            ':user_id' => $task['user_id'],
            ':title' => $task['title'],
            ':description' => $task['description'],
            ':category' => $task['category'],
            ':priority' => $task['priority'],
            ':deadline' => $task['deadline'],
            ':creation_date' => $task['creation_date'],
            ':completion_date' => $task['completion_date'],
            ':is_completed' => $task['is_completed'],
            ':streak_contribution' => $task['streak_contribution']
        ]);
    }

    public function getTasksForUser($user) {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user->getUserId(), PDO::PARAM_INT);
        $stmt->execute();

        $topUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $topUsers; 
    }
}