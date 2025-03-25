<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . "/../dto/PurchaseDto.php");

class PurchseModel extends BaseModel {
    public function createPurchase(int $userId, int $itemId): bool {
        $query = "INSERT INTO purchase (user_id, store_item_id)
                  VALUES (:user_id, :store_item_id)";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':store_item_id', $itemId);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    
        return true;
    }

    public function getPurchasesForUser(int $userId): array {
        $query = "SELECT * FROM purchase WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId);

        if (!$stmt->execute()) {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return [];
        }

        $purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $purchasesArray = [];
        foreach ($purchases as $purchase) {
            $purchasesArray[] = new PurchaseDto(
                $purchase['purchase_id'],
                $purchase['user_id'],   
                $purchase['store_item_id']
            );
        }

        return $purchasesArray;
    }
}