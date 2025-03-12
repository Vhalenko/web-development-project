<section class="main-content">
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-md-8">
                <h2>Manage Your Tasks</h2>
                <ul class="list-group mb-4">

                    <?php foreach ($tasks as $task) { ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= htmlspecialchars($task->getTitle()) ?></strong>
                                <p class="text-muted mb-0">
                                    Priority: <?= htmlspecialchars($task->getPriority()) ?> |
                                    Deadline: <?= htmlspecialchars($task->getDeadline()) ?>
                                </p>
                            </div>
                            <div>
                                <a href="/complete-task/<?= $task->getTaskId() ?>" class="btn btn-sm btn-success">Complete</a>
                                <a href="/edit-task/<?= $task->getTaskId() ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="/remove-task/<?= $task->getTaskId() ?>" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-md-4">
                <h2>Add New Task</h2>
                <form action="/add-task" method="POST">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>