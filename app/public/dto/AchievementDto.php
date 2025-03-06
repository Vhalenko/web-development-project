<?php

class AchievementDto {
    private $achievementId;
    private $name;
    private $description;
    private $rewardPoints;
    private $unlockCriteria;

    public function __construct($achievementId, $name, $description, $rewardPoints, $unlockCriteria) {
        $this->achievementId = $achievementId;
        $this->name = $name;
        $this->description = $description;
        $this->rewardPoints = $rewardPoints;
        $this->unlockCriteria = $unlockCriteria;
    }

    // Getters and Setters
    public function getAchievementId() {
        return $this->achievementId;
    }
    public function setAchievementId($achievementId) {
        $this->achievementId = $achievementId;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }
    public function setDescription($description) {
        $this->description = $description;
    }

    public function getRewardPoints() {
        return $this->rewardPoints;
    }
    public function setRewardPoints($rewardPoints) {
        $this->rewardPoints = $rewardPoints;
    }

    public function getUnlockCriteria() {
        return $this->unlockCriteria;
    }
    public function setUnlockCriteria($unlockCriteria) {
        $this->unlockCriteria = $unlockCriteria;
    }
}
