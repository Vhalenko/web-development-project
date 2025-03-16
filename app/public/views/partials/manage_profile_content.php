<?php 
    $storeItemController = new StoreItemController();
    $availablePictures = ['default-profile.jpg'];
    foreach($purchases as $purchase) {
        $item = $storeItemController->getStoreItemById($purchase->getItemId());
        $availablePictures[] = $item->getAssetPath();
    }
    
    $profilePicture = $user->getSelectedAvatar() ?: 'default-profile.jpg';
?>

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-md-6">
            <!-- Card for better UI -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Manage Account</h4>
                </div>
                <div class="card-body p-4">
                    <form id="edit-form" action="/update-account" method="POST">

                        <!-- Profile Picture Selection -->
                        <div class="mb-3 text-center">
                            <img id="profilePreview" 
                                 src="../../assets/img/profiles/<?php echo htmlspecialchars($profilePicture); ?>" 
                                 class="rounded-circle mb-3" 
                                 alt="Profile Picture" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                            
                            <select class="form-control mt-2" id="profilePicture" name="selected_avatar">
                                <?php foreach ($availablePictures as $picture): ?>
                                    <option value="<?= $picture ?>" <?= $picture === $profilePicture ? 'selected' : '' ?>>
                                        <?= ucfirst(pathinfo($picture, PATHINFO_FILENAME)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->getUsername(); ?>" required>
                        </div>

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo $user->getFullName(); ?>" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->getEmail(); ?>" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                            <a href="/profile" class="btn btn-outline-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('profilePicture').addEventListener('change', function() {
        const selectedPicture = this.value;
        document.getElementById('profilePreview').src = `../../assets/img/profiles/${selectedPicture}`;
    });
</script>

