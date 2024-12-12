<?php

class Streak {
    private $streakId;
    private $userId;
    private $startDate;
    private $endDate;
    private $currentLength;
    private $longestLength;

    public function __construct($streakId, $userId, $startDate, $currentLength, $longestLength, $endDate = null) {
        $this->streakId = $streakId;
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->currentLength = $currentLength;
        $this->longestLength = $longestLength;
    }

    // Getters and Setters
    public function getStreakId() {
        return $this->streakId;
    }
    public function setStreakId($streakId) {
        $this->streakId = $streakId;
    }

    public function getUserId() {
        return $this->userId;
    }
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getStartDate() {
        return $this->startDate;
    }
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    public function getCurrentLength() {
        return $this->currentLength;
    }
    public function setCurrentLength($currentLength) {
        $this->currentLength = $currentLength;
    }

    public function getLongestLength() {
        return $this->longestLength;
    }
    public function setLongestLength($longestLength) {
        $this->longestLength = $longestLength;
    }
}
