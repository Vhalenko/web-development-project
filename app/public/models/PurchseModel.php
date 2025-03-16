<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . "/../dto/PurchaseDto.php");

class PurchseModel extends BaseModel {
    public function create(int $userId, int $itemId) {
        $query = "INSERT INTO purchase (user_id, store_item_id)
                  VALUES (:user_id, :store_item_id)";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':store_item_id', $itemId);

        try {
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getPurchasesForUser(int $userId): array {
        $query = "SELECT * FROM purchase WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':user_id', $userId);

        $stmt->execute();

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