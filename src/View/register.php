<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center">Register</h2>
    
        <form method="POST" action="/register" class="card p-4 shadow">
            <input type="hidden" name="csrf_token" value="<?= \App\CSRF::generateToken(); ?>">

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="<?= $data['email'] ?? ''; ?>" id="email" name="email" class="form-control <?= (!empty($errors['email'])) ? 'is-invalid' : ''; ?>" placeholder="Enter your email">
                <?php if (!empty($errors['email'])): ?>
                    <div class="invalid-feedback">
                        <small><?= htmlspecialchars($errors['email']); ?></small>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" value="<?= $data['password'] ?? '';?>" id="password" name="password" class="form-control <?= (!empty($errors['password'])) ? 'is-invalid' : ''; ?>" placeholder="Enter your password">
                <?php if(!empty($errors['password'])): ?>
                    <div class="invalid-feedback">
                        <small><?= htmlspecialchars($errors['password']); ?></small>
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
</div>