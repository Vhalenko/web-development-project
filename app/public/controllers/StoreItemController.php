<?php

require_once(__DIR__ . "/../models/StoreItemModel.php");

class StoreItemController {
    private StoreItemModel $storeItemModel;

    public function __construct()
    {
        $this->storeItemModel = new StoreItemModel();
    }

    public function getAllStoreItems(): array {
        return $this->storeItemModel->getAllStoreItems();
    }

    public function getAvatars(): array {
        $storeItems = $this->storeItemModel->getAllStoreItems();

        $avatars = array_filter($storeItems, function($item) {
            return $item->getType() === Type::Avatar;
        });

        return $avatars;
    }

    public function getStoreItemById(int $id): ?StoreItemDto {
        return $this->storeItemModel->getStoreItemById($id);
    }
}