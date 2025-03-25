<section class="main-content">
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-md-8">
                <h2>Manage Your Tasks</h2>

                <div class="mb-4">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                            Sort by
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item sort-btn" href="#" data-sort="priority">Priority</a></li>
                            <li><a class="dropdown-item sort-btn" href="#" data-sort="deadline">Deadline</a></li>
                        </ul>
                    </div>

                    <div class="btn-group">
                        <button class="btn btn-outline-success filter-btn" data-filter="completed">Completed</button>
                        <button class="btn btn-outline-warning active filter-btn" data-filter="incompleted">Incomplete</button>
                        <button class="btn btn-outline-secondary filter-btn" data-filter="all">All</button>
                    </div>
                </div>

                <ul class="list-group mb-4"></ul>
            </div>

            <div class="col-md-4">
                <div id="alert-box" class="alert alert-danger d-none">
                    <p id="alert-message"></p>
                </div>

                <h2 for="addTaskForm">Add New Task</h2>
                <form id="addTaskForm" method="POST">
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
                    <button id="add-task-btn" class="btn btn-primary w-100">Add Task</button>
                </form>

                <h2 for="editTaskForm" style="display: none;">Edit Task</h2>
                <form id="editTaskForm" method="POST" style="display: none;">
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
                    <button id="edit-task-btn" class="btn btn-primary w-100">Save Changes</button>
                    <a type="button" id="cancelEditBtn" class="btn btn-secondary w-100 mt-2 cancel-btn">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="../../assets/js/task.js"></script>