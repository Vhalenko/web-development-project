<?php

require_once(__DIR__ . "/../models/PurchseModel.php");
require_once(__DIR__ . "/../models/UserModel.php");

class PurchaseController
{
    private PurchseModel $purchaseModel;
    private UserModel $userModel;

    public function __construct()
    {
        $this->purchaseModel = new PurchseModel();
        $this->userModel = new UserModel();
    }

    public function create(UserDto $user, StoreItemDto $item)
    {
        if ($user->getTotalPoints() > $item->getPrice()) {
            $this->userModel->editUser($user->getUserId(), null, null, null, null, null, $user->getTotalPoints() - $item->getPrice());
            $this->purchaseModel->create($user->getUserId(), $item->getId());
            $_SESSION['congrat'] = 'the item was successfully bought. you can now chnge your avatar in the profile';
            header("Location: /store");
        } else {
            $_SESSION['error'] = 'you do not have enough points';
            header("Location: /store");
            exit;
        }
    }

    public function getPurchasesForUser(int $userId): array
    {
        $purchases = $this->purchaseModel->getPurchasesForUser($userId);
        $seen = [];

        $uniquePurchases = array_filter($purchases, function ($purchase) use (&$seen) {
            $itemId = $purchase->getItemId();
            if (!isset($seen[$itemId])) {
                $seen[$itemId] = true;
                return true;
            }
            return false;
        });

        return array_values($uniquePurchases);
    }
}
