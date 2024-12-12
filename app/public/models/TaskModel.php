<?php

class Task {
    private $id;
    private $title;
    private $description;
    private $isCompleted;

    public function __construct($id, $title, $description, $isCompleted = false) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->isCompleted = $isCompleted;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function isCompleted() {
        return $this->isCompleted;
    }

    // Setters
    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setCompleted($isCompleted) {
        $this->isCompleted = $isCompleted;
    }

    // Example method to save the task to a database
    public function save() {
        // Add logic to insert/update the task in the database
    }
}
