<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.  "/../partials/head.php";?>
</head>
<body>
    
    <?php require_once __DIR__.  "/../partials/header_nav.php";?>
    
    <section class="main-content">
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-md-8">
                <h2>Manage Your Tasks</h2>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Finish Homework</strong>
                            <p class="text-muted mb-0">Priority: High | Deadline: 2024-12-10</p>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-success">Complete</button>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Plan Weekend Trip</strong>
                            <p class="text-muted mb-0">Priority: Medium | Deadline: 2024-12-15</p>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-success">Complete</button>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-md-4">
                <h2>Add New Task</h2>
                <form>
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Task Title</label>
                        <input type="text" id="taskTitle" class="form-control" placeholder="Enter task title">
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select id="priority" class="form-select">
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" id="deadline" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="taskDescription" class="form-label">Task Description</label>
                        <input type="textarea" id="taskDescription" class="form-control" placeholder="Enter task title">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Task</button>
                </form>
            </div>
        </div>
    </div>
</section>

    <?php require_once __DIR__.  "/../partials/footer.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
