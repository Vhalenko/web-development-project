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
            $creationDate = new DateTime('now');
            $completionDate = null;
            $isCompleted = false;

            if ($this->taskModel->addTask($userId, $title, $description, $priority, $deadline, $creationDate, $completionDate, $isCompleted)) {
                header("Location: /tasks");
            }
            else {
                echo "Error creting a task";
            }
        }
    }

    public function removeTask(int $taskId)
    {
        $this->taskModel->removeTask($taskId);
        header("Location: /tasks");
    }

    public function editTask(TaskDto $task)
    {
        $this->taskModel->editTask($task);
    }

    public function getTasksForUser(int $userId)
    {
        return $this->taskModel->getTasksForUser($userId);
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
}
