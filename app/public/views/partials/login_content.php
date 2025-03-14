<section class="main-content">
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <i class="bi bi-check-circle fs-1 text-primary"></i>
                    <h3>Task Management</h3>
                    <img src="../../assets/img/Time-management-img.jpg" alt="" class="time-management-img">
                    <p>Organize your tasks into categories and prioritize effectively.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-award fs-1 text-success"></i>
                    <h3>Gamification</h3>
                    <img src="../../assets/img/Gamification-img.jpg" alt="" class="gamification-img">
                    <p>Earn rewards and track progress with engaging features.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-people fs-1 text-danger"></i>
                    <h3>Collaboration</h3>
                    <img src="../../assets/img/Collaboration-img.jpg" alt="" class="collaboration-img">
                    <p>Work with friends and achieve more together.</p>
                </div>
            </div>
        </div>
    </section>

    <header class=" text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Gamify Your Life</h1>
            <p class="lead">Build habits, complete tasks, and achieve your goals while having fun.</p>

            <!-- Login Form -->
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
                        <a href="/signup-page" type="button" class="btn btn-primary">Sign up</a>
                    </div>
                </div>
            </form>
        </div>
    </header>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
