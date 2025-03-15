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
                                    Priority: <?= htmlspecialchars($task->getPriority()->value) ?> |
                                    Deadline: <?= htmlspecialchars($task->getDeadline()->format('Y-m-d')) ?>
                                </p>
                            </div>
                            <div>
                                <a href="javascript:void(0);" class="btn btn-sm btn-warning edit-btn" 
                                   data-task-id="<?= $task->getTaskId() ?>" 
                                   data-task-title="<?= htmlspecialchars($task->getTitle()) ?>"
                                   data-task-priority="<?= htmlspecialchars($task->getPriority()->value) ?>"
                                   data-task-deadline="<?= htmlspecialchars($task->getDeadline()->format('Y-m-d')) ?>"
                                   data-task-description="<?= htmlspecialchars($task->getDescription()) ?>"
                                >Edit</a>
                                <a href="/complete-task/<?= $task->getTaskId() ?>" class="btn btn-sm btn-success">Complete</a>
                                <a href="/remove-task/<?= $task->getTaskId() ?>" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-md-4">
                <h2 for="addTaskForm">Add New Task</h2>
                <form id="addTaskForm" action="/add-task" method="POST">
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Task Title</label>
                        <input type="text" id="taskTitle" name="title" class="form-control" placeholder="Enter task title" required>
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select id="priority" name="priority" class="form-select">
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" id="deadline" name="deadline" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskDescription" class="form-label">Task Description</label>
                        <input type="textarea" id="taskDescription" name="description" class="form-control" placeholder="Enter task description">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Task</button>
                </form>

                <h2 for="editTaskForm" style="display: none;">Edit Task</h2>
                <form id="editTaskForm" action="/edit-task" method="POST" style="display: none;">
                    <input type="hidden" id="editTaskId" name="task_id">
                    <div class="mb-3">
                        <label for="editTaskTitle" class="form-label">Task Title</label>
                        <input type="text" id="editTaskTitle" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPriority" class="form-label">Priority</label>
                        <select id="editPriority" name="priority" class="form-select">
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDeadline" class="form-label">Deadline</label>
                        <input type="date" id="editDeadline" name="deadline" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTaskDescription" class="form-label">Task Description</label>
                        <input type="textarea" id="editTaskDescription" name="description" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    <a type="button" id="cancelEditBtn" class="btn btn-secondary w-100 mt-2 cancel-btn">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Link to the external JavaScript file -->
<script src="../../assets/js/main.js"></script>