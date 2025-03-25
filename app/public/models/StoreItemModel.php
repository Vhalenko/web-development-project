<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . "/../dto/StoreItemDto.php");

class StoreItemModel extends BaseModel
{
    public function getAllStoreItems(): array
    {
        $query = "SELECT * FROM store_item";
        $stmt = $this->pdo->prepare($query);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return [];
        }

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $itemsArray = [];

        foreach ($items as $item) {
            $type = Type::from($item['type']);
            $itemsArray[] = new StoreItemDto(
                $item['id'],
                $type,
                $item['price'],
                $item['asset_path']
            );
        }

        return $itemsArray;
    }

    public function getStoreItemById(int $id): ?StoreItemDto
    {
        $query = "SELECT * FROM store_item WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return null;
        }

        $item = $stmt->fetch();

        $type = Type::from($item['type']);
        return new StoreItemDto(
            $item['id'],
            $type,
            $item['price'],
            $item['asset_path']
        );
    }
}