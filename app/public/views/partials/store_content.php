<!-- store-items.php -->
<div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="row w-100">
        <h2 class="w-100 text-center mb-5">Store Items</h2>

        <?php $error = $_SESSION['error'] ?? []; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php $congrat = $_SESSION['congrat'] ?? []; ?>
        <?php if (!empty($congrat)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($congrat) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php foreach ($storeItems as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card store-item-card">
                    <img src="../../assets/img/profiles/<?php echo htmlspecialchars($item->getAssetPath()) ?>"
                        class="card-img-top rounded-circle"
                        alt="<?= htmlspecialchars($item->getType()->value) ?>"
                        style="width: 150px; height: 150px; object-fit: cover; margin: 20px auto;">
                    <div class="card-body text-center">
                        <h5 class="text-light"><?= htmlspecialchars($item->getType()->value) ?></h5>
                        <p class="text-light d-flex justify-content-center align-items-center">
                            <img src="../../assets/img/coin.png" alt="Coin" style="width: 20px; height: 20px; margin-right: 5px;">
                            <?= htmlspecialchars($item->getPrice()) ?> coins
                        </p>
                        <a href="/purchase/<?= $item->getId() ?>" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>