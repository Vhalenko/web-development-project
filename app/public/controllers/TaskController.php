<?php

require_once(__DIR__ . "/../models/TaskModel.php");
require_once(__DIR__ . "/../dto/TaskDto.php");
require_once(__DIR__ . "/../dto/UserDto.php");

class TaskController
{
    private TaskModel $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function addTask()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $priority = $_POST['priority'];
            $deadline = DateTime::createFromFormat('Y-m-d', $_POST['deadline']);
            $creationDate = new DateTime('today');
            $completionDate = null;
            $isCompleted = false;

            if($creationDate > $deadline) {
                $_SESSION['error'] = 'the deadline cannot be before creation date';
                header("Location: /tasks");
                exit;
            }

            if ($this->taskModel->addTask($userId, $title, $description, $priority, $deadline, $creationDate, $completionDate, $isCompleted)) {
                header("Location: /tasks");
            } else {
                echo "Error creting a task";
            }
        }
    }

    public function removeTask(int $taskId)
    {
        $this->taskModel->removeTask($taskId);
        header("Location: /tasks");
    }

    public function editTask(int $taskId)
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $deadline = DateTime::createFromFormat('Y-m-d', $_POST['deadline']);

        if(new DateTime('today') > $deadline) {
            $_SESSION['error'] = 'the deadline cannot be before creation date';
            header("Location: /tasks");
            exit;
        }
        
        $this->taskModel->editTask($taskId, $title, $description, $priority, $deadline);
        header("Location: /tasks");
    }

    public function getTask(int $id)
    {
        return $this->taskModel->getTask($id);
    }

    public function completeTask(int $id)
    {
        $this->taskModel->completeTask($id);
        header("Location: /tasks");
    }

    public function getAllTasks() {
        $userId = $_SESSION['user']['id'];
        return $this->taskModel->getTasksForUser($userId);
    }

    public function getUncompletedTasks()
    {
        $tasks = $this->getAllTasks();

        $uncompletedTasks = array_filter($tasks, function($task) {
            return !$task->getIsCompleted();
        });

        return $uncompletedTasks;
    }

    public function getCompletedTasks()
    {
        $tasks = $this->getAllTasks();

        $completedTasks = array_filter($tasks, function($task) {
            return $task->getIsCompleted();
        });

        return $completedTasks;
    }

    public function sortTasksByDeadline(array $tasks): array {
        usort($tasks, function($a, $b) {
            if ($a->getDeadline() == $b->getDeadline()) {
                return 0;
            }
            return ($a->getDeadline() < $b->getDeadline()) ? -1 : 1;
        });

        return $tasks;
    }

    public function sortTasksByPriority(array $tasks): array {
        usort($tasks, function($a, $b) {
            $priorityOrder = ['high' => 1, 'medium' => 2, 'low' => 3];
            
            $priorityA = $a->getPriority()->value; 
            $priorityB = $b->getPriority()->value;
    
            if ($priorityOrder[$priorityA] === $priorityOrder[$priorityB]) {
                return 0;
            }
    
            return ($priorityOrder[$priorityA] < $priorityOrder[$priorityB]) ? -1 : 1;
        });
    
        return $tasks;
    }
    
}
