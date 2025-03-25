document.addEventListener("DOMContentLoaded", async () => {
    await loadTasks();
    setupEventListeners();
});

async function loadTasks(filter = "incompleted", sort = "deadline") {
    try {
        const response = await fetch(`/api/tasks?filter=${filter}&sort=${sort}`);
        if (!response.ok) throw new Error("Failed to fetch tasks");

        const { tasks } = await response.json();
        const taskList = document.querySelector(".list-group");
        taskList.innerHTML = "";

        tasks.forEach(task => {
            const formattedDeadline = new Date(task.deadline.date).toLocaleDateString('en-CA');
            taskList.appendChild(createTaskElement(task, formattedDeadline));
        });
    } catch (error) {
        console.error("Error loading tasks:", error);
    }
}

function createTaskElement(task, deadline) {
    const li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between align-items-center";
    li.innerHTML = `
        <div>
            <strong>${escapeHtml(task.title)}</strong>
            <p class="text-muted mb-0">
                Priority: ${escapeHtml(task.priority)} | Deadline: ${escapeHtml(deadline)}
            </p>
        </div>
        <div>
            <button class="btn btn-sm btn-warning edit-btn" data-task='${JSON.stringify(task)}'>Edit</button>
            <button class="btn btn-sm btn-success complete-btn" data-task-id="${task.taskId}">Complete</button>
            <button class="btn btn-sm btn-danger delete-btn" data-task-id="${task.taskId}">Delete</button>
        </div>
    `;
    return li;
}

function setupEventListeners() {
    document.getElementById("add-task-btn").addEventListener("click", handleTaskSubmit);
    document.getElementById("edit-task-btn").addEventListener("click", handleTaskEdit);
    
    document.body.addEventListener("click", (event) => {
        const target = event.target;
        if (target.classList.contains("edit-btn")) handleEditClick(target);
        else if (target.classList.contains("cancel-btn")) toggleForms(false);
        else if (target.classList.contains("complete-btn")) completeTask(target.dataset.taskId);
        else if (target.classList.contains("delete-btn")) deleteTask(target.dataset.taskId);
    });

    setupFilterAndSort();
}

function setupFilterAndSort() {
    document.querySelectorAll(".filter-btn").forEach(button => {
        button.addEventListener("click", function () {
            document.querySelectorAll(".filter-btn").forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            loadTasks(this.dataset.filter, getActiveSort());
        });
    });

    document.querySelectorAll(".sort-btn").forEach(button => {
        button.addEventListener("click", function () {
            document.querySelectorAll(".sort-btn").forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            loadTasks(getActiveFilter(), this.dataset.sort);
        });
    });
}

async function handleTaskSubmit(event) {
    event.preventDefault();
    
    const taskData = getTaskData();
    if (!validateTask(taskData)) return;

    const response = await sendRequest("/api/task", "POST", taskData);
    if (response) {
        hideError();
        loadTasks();
    }
}

async function handleTaskEdit(event) {
    event.preventDefault();

    const taskId = document.getElementById("editTaskId").value;
    const taskData = getTaskData(true);
    if (!validateTask(taskData)) return;

    const response = await sendRequest(`/api/task/edit/${taskId}`, "POST", taskData);
    if (response) {
        toggleForms(false);
        hideError();
        loadTasks();
        document.getElementById("editTaskForm").reset();
    }
}

function getTaskData(isEdit = false) {
    return {
        title: document.getElementById(isEdit ? "editTaskTitle" : "taskTitle").value,
        priority: document.getElementById(isEdit ? "editPriority" : "priority").value,
        deadline: document.getElementById(isEdit ? "editDeadline" : "deadline").value,
        description: document.getElementById(isEdit ? "editTaskDescription" : "taskDescription").value
    };
}

function validateTask({ title, deadline }) {
    if (!title) return displayError("Please add a task title"), false;
    if (deadline < new Date().toISOString().split("T")[0]) return displayError("Deadline cannot be before today."), false;
    return true;
}

async function sendRequest(url, method, body) {
    try {
        const response = await fetch(url, {
            method,
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(body)
        });
        const data = await response.json();
        if (!response.ok) throw new Error(data.error || "An error occurred");
        return true;
    } catch (error) {
        alert(error.message);
        return false;
    }
}

function handleEditClick(button) {
    const task = JSON.parse(button.dataset.task);
    document.getElementById("editTaskId").value = task.taskId;
    document.getElementById("editTaskTitle").value = task.title;
    document.getElementById("editPriority").value = task.priority;
    document.getElementById("editDeadline").value = new Date(task.deadline.date).toISOString().split("T")[0];
    document.getElementById("editTaskDescription").value = task.description || "";

    toggleForms(true);
}

function toggleForms(editMode) {
    document.getElementById("addTaskForm").style.display = editMode ? "none" : "block";
    document.getElementById("editTaskForm").style.display = editMode ? "block" : "none";
}

async function deleteTask(id) {
    if (confirm("Are you sure you want to delete this task?")) {
        if (await sendRequest(`/api/task/${id}`, "DELETE")) loadTasks();
    }
}

async function completeTask(id) {
    if (await sendRequest(`/api/task/complete/${id}`, "PUT")) loadTasks();
}

function escapeHtml(str) {
    const div = document.createElement("div");
    div.textContent = str;
    return div.innerHTML;
}

function displayError(message) {
    document.getElementById("alert-box").classList.remove('d-none');
    document.getElementById("alert-message").textContent = message;
}

function hideError() {
    document.getElementById("alert-box").classList.add('d-none');
}

function getActiveFilter() {
    return document.querySelector(".filter-btn.active")?.dataset.filter || "all";
}

function getActiveSort() {
    return document.querySelector(".sort-btn.active")?.dataset.sort || "deadline";
}