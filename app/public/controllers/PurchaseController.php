<?php

require_once(__DIR__ . "/../models/PurchseModel.php");
require_once(__DIR__ . "/../models/UserModel.php");

class PurchaseController {
    private PurchseModel $purchaseModel;
    private UserModel $userModel;

    public function __construct()
    {
        $this->purchaseModel = new PurchseModel();
        $this->userModel = new UserModel();
    }

    public function create(UserDto $user, StoreItemDto $item) {
        if ($user->getTotalPoints() > $item->getPrice()) {
            $this->userModel->editUser($user->getUserId(), null, null, null, null, null, $user->getTotalPoints() - $item->getPrice());
            $this->purchaseModel->create($user->getUserId(), $item->getId());
            header("Location: /store");
        }
        else {
            exit;
        }
    }

    public function getPurchasesForUser(int $userId) :array {
        return $this->purchaseModel->getPurchasesForUser($userId);
    }
}