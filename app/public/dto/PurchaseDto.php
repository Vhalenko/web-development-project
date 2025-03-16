<?php

class PurchaseDto {
    private int $id;
    private int $userId;
    private int $itemId;

    public function __construct(int $id, int $userId, int $itemId) {
        $this->id = $id;
        $this->userId = $userId;
        $this->itemId = $itemId;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getItemId(): int {
        return $this->itemId;
    }
}