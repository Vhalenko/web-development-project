<section class="py-5">
    <section class="py-5">
        <div class="container">
            <div class="row text-center homepage-welcome-section">
                <div class="col-12">
                    <h2 class="display-4 fw-bold mb-4">Welcome to Your New Favorite To-Do App</h2>
                    <p class="lead">Transform the way you approach your tasks with our web-based to-do app that turns everyday productivity into a fun, engaging experience.</p>
                </div>

                <div class="col-md-6">
                    <h3 class="fw-bold text-primary mb-3">Task Management Made Easy</h3>
                    <p>Our intuitive task management system allows you to organize your day with ease. Categorize your tasks, set priorities, and define deadlines to stay on top of your game. Whether it's personal goals or work tasks, you can easily structure your day and track your progress.</p>
                </div>

                <div class="col-md-6">
                    <h3 class="fw-bold text-primary mb-3">Gamification for Motivation</h3>
                    <p>We believe in making productivity fun! With our gamification features, you’ll earn rewards for completing tasks, unlock achievements, and compete with friends. Track your progress, set streaks, and get rewarded for staying consistent. Say goodbye to boring to-do lists and hello to a new way of achieving your goals!</p>
                </div>

                <div class="col-12 mt-5">
                    <h3 class="fw-bold text-primary mb-3">Why Choose Our App?</h3>
                    <p>Our app doesn’t just help you stay organized; it makes the process enjoyable. With personalized features like task customization, challenges, and a built-in leaderboard, you’ll feel motivated every step of the way. Collaborate with others, compare your performance, and level up as you complete more tasks and reach milestones.</p>
                </div>

                <div class="col-12 text-center mt-4">
                    <a href="#signUpForm" class="btn btn-primary btn-lg">Start Your Journey Today</a>
                </div>
            </div>

        </div>
    </section>

    <div class="container">
        <div class="row text-center">
            <!-- Task Management Feature -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 p-4 h-100">
                    <i class="bi bi-check-circle fs-1 text-primary mb-3"></i>
                    <h3 class="fw-bold mb-3">Task Management</h3>
                    <img src="../../assets/img/Time-management-img.jpg" alt="Task Management" class="img-fluid rounded mb-3 feature-img">
                    <p>Organize your tasks into categories, set deadlines, and prioritize effectively to stay productive.</p>
                    <a href="/features#task-management" class="btn btn-outline-primary mt-3">Learn More</a>
                </div>
            </div>

            <!-- Gamification Feature -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 p-4 h-100">
                    <i class="bi bi-award fs-1 text-success mb-3"></i>
                    <h3 class="fw-bold mb-3">Gamification</h3>
                    <img src="../../assets/img/Gamification-img.jpg" alt="Gamification" class="img-fluid rounded mb-3 feature-img">
                    <p>Earn rewards, complete challenges, and track your progress with exciting gamification features.</p>
                    <a href="/features#gamification" class="btn btn-outline-success mt-3">Explore More</a>
                </div>
            </div>

            <!-- Collaboration Feature -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 p-4 h-100">
                    <i class="bi bi-people fs-1 text-danger mb-3"></i>
                    <h3 class="fw-bold mb-3">Collaboration</h3>
                    <img src="../../assets/img/Collaboration-img.jpg" alt="Collaboration" class="img-fluid rounded mb-3 feature-img">
                    <p>Work together with friends, share tasks, and achieve your goals as a team.</p>
                    <a href="/features#collaboration" class="btn btn-outline-danger mt-3">Join Now</a>
                </div>
            </div>
        </div>

    </div>

    <header class=" text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Gamify Your Life</h1>
            <p class="lead">Build habits, complete tasks, and achieve your goals while having fun.</p>

            <form action="/signup" class="sign-up-form" id="signUpForm" method="POST">
                <h2 class="display-8 fw-bold text-center mb-4">Sign up</h2>

                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                </div>

                <div class="mb-3">
                    <label for="fullName" class="form-label">Full name:</label>
                    <input type="text" id="fullName" name="fullName" class="form-control" placeholder="Enter your username" required>
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
    </header>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>