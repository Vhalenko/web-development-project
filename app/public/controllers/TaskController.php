<?php

require_once(__DIR__ . "/../../models/TaskModel.php");
require_once(__DIR__ . "/../../dto/TaskDto.php");
require_once(__DIR__ . "/../dto/UserDto.php");

class TaskController
{
    private TaskModel $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function addTask() {
        $userId = $_SESSION['user']['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];
        $creationDate = new DateTime('now');
        $completionDate = null;
        $isCompleted = false;

        $this->taskModel->addTask($userId, $title, $description, $priority, $deadline, $creationDate, $completionDate, $isCompleted);
    }

    public function removeTask(TaskDto $task) {
        $this->taskModel->removeTask($task);
    }

    public function editTask(TaskDto $task) {
        $this->taskModel->editTask($task);
    }

    public function getTasksForUser(UserDto $user) {
        return $this->taskModel->getTasksForUser($user);
    }

    public function getTask(int $id) {
        return $this->taskModel->getTask($id);
    }

    public function completeTask(int $id) {
        $this->taskModel->completeTask($id);
    }
}