<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    <form action="/signup" class="sign-up-form" id="signUpForm" method="POST">
        <h2 class="display-8 fw-bold text-center mb-4">Sign up</h2>

        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <button id="signUpButton" type="submit" class="btn btn-primary">Sign up</button>
            <div>
                <label class="me-2">Already have an account?</label>
                <a href="/login-page" type="button" class="btn btn-outline-secondary">Login</a>
            </div>
        </div>
    </form>
</div>

<!-- Optional: Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
