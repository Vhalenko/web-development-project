<div class="container-fluid min-vh-100 d-flex flex-column align-items-center justify-content-center">
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold text-primary">Welcome Back to Your Productivity Hub</h1>
        <p class="lead text-light">We're excited to see you continue your journey of completing tasks, unlocking achievements, and leveling up your productivity.</p>
    </div>
    <form action="/login" class="login-form" id="loginForm" method="POST">
        <h2 class="display-8 fw-bold text-center">Login</h2>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button id="loginButton" type="submit" class="btn btn-primary">Login</button>
            <div>
                <label class="me-2">Don't have an account?</label>
                <a href="/#signUpForm" class="btn btn-outline-secondary">Sign up</a>
            </div>
        </div>
    </form>
</div>

