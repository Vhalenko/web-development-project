document.addEventListener("DOMContentLoaded", async function () {
    await loadTasks();

    document.getElementById("add-task-btn").addEventListener("click", async function(event) {
        event.preventDefault();
    
        const taskTitle = document.getElementById("taskTitle").value;
        const priority = document.getElementById("priority").value;
        const deadline = document.getElementById("deadline").value;
        const taskDescription = document.getElementById("taskDescription").value;
    
        const taskData = {
            title: taskTitle,
            priority: priority,
            deadline: deadline,
            description: taskDescription
        };

        const today = new Date().toISOString().split("T")[0];

        if (deadline < today) {
            alert("Deadline cannot be before today.");
            return;
        }
    
        const response = await fetch("/api/task", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(taskData)
        });
    
        const responseData = await response.json();
    
        if (response.ok) {
            loadTasks();
        } else {
            alert(responseData.error || "An error occurred while adding the task");
        }
    });

    document.getElementById("edit-task-btn").addEventListener("click", async function(event) {
        event.preventDefault();
    
        const taskId = document.getElementById("editTaskId").value;
        const taskTitle = document.getElementById("editTaskTitle").value;
        const priority = document.getElementById("editPriority").value;
        const deadline = document.getElementById("editDeadline").value;
        const taskDescription = document.getElementById("editTaskDescription").value;
    
        const taskData = {
            title: taskTitle,
            priority: priority,
            deadline: deadline,
            description: taskDescription
        };

        const today = new Date().toISOString().split("T")[0];

        if (deadline < today) {
            alert("Deadline cannot be before today.");
            return;
        }
    
        const response = await fetch(`/api/task/edit/${taskId}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(taskData) 
        });
    
        const responseData = await response.json();  
    
        if (response.ok) {
            alert("Task updated successfully!");
            loadTasks();
            toggleForms(false);
            document.getElementById("editTaskForm").reset();
        } else {
            alert(responseData.error || "An error occurred while updating the task");
        }
    });

    document.querySelectorAll(".filter-btn").forEach(button => {
        button.addEventListener("click", function() {
            const filter = this.getAttribute("data-filter");
            const sort = document.querySelector(".sort-btn.active")?.getAttribute("data-sort") || "deadline";
            loadTasks(filter, sort);
        });
    });
    
    document.querySelectorAll(".sort-btn").forEach(button => {
        button.addEventListener("click", function() {
            document.querySelectorAll(".sort-btn").forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
    
            const sort = this.getAttribute("data-sort");
            const filter = document.querySelector(".filter-btn.active")?.getAttribute("data-filter") || "all";
            loadTasks(filter, sort);
        });
    });  
    
    document.body.addEventListener("click", function (event) {
        const target = event.target;

        if (target.classList.contains("edit-btn")) {
            handleEditClick(target);
        } else if (target.classList.contains("cancel-btn")) {
            toggleForms(false);
        } else if (target.classList.contains("complete-btn")) {
            event.preventDefault();
            completeTask(target.dataset.taskId);
        } else if (target.classList.contains("delete-btn")) {
            event.preventDefault();
            deleteTask(target.dataset.taskId);
        }
    });
});

async function loadTasks(filter = "incompleted", sort = "deadline") {
    try {
        const response = await fetch(`/api/tasks?filter=${filter}&sort=${sort}`);
        if (!response.ok) throw new Error("Failed to fetch tasks");

        const data = await response.json();
        const taskList = document.querySelector(".list-group");
        taskList.innerHTML = "";

        Object.values(data.tasks).forEach((task) => {
            const formattedDeadline = new Date(task.deadline.date).toISOString().split("T")[0];

            const li = document.createElement("li");
            li.className = "list-group-item d-flex justify-content-between align-items-center";
            li.innerHTML = `
                <div>
                    <strong>${escapeHtml(task.title)}</strong>
                    <p class="text-muted mb-0">
                        Priority: ${escapeHtml(task.priority)} | 
                        Deadline: ${escapeHtml(formattedDeadline)}
                    </p>
                </div>
                <div>
                    <a href="javascript:void(0);" class="btn btn-sm btn-warning edit-btn"
                        data-task-id="${task.taskId}">Edit</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-success complete-btn" data-task-id="${task.taskId}">Complete</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-danger delete-btn" data-task-id="${task.taskId}">Delete</a>
                </div>
            `;
            taskList.appendChild(li);
        });
    } catch (error) {
        console.error("Error loading tasks:", error);
    }
}


function handleEditClick(button) {
    document.getElementById("editTaskId").value = button.dataset.taskId;
    document.getElementById("editTaskTitle").value = button.dataset.taskTitle;
    document.getElementById("editPriority").value = button.dataset.taskPriority;
    document.getElementById("editDeadline").value = button.dataset.taskDeadline;
    document.getElementById("editTaskDescription").value = button.dataset.taskDescription;

    document.getElementById("editTaskForm").action = `/edit-task/${button.dataset.taskId}`;
    toggleForms(true);
}

function toggleForms(editMode) {
    document.getElementById("addTaskForm").style.display = editMode ? "none" : "block";
    document.querySelector('h2[for="addTaskForm"]').style.display = editMode ? "none" : "block";
    
    document.getElementById("editTaskForm").style.display = editMode ? "block" : "none";
    document.querySelector('h2[for="editTaskForm"]').style.display = editMode ? "block" : "none";
}

async function deleteTask(id) {
    if (confirm("Are you sure you want to delete this task?")) {
        const response = await fetch(`/api/task/${id}`, { method: "DELETE" });
        if (response.ok) loadTasks();
        else alert("Failed to delete task");
    }
}

async function completeTask(id) {
    const response = await fetch(`/api/task/complete/${id}`, { method: "PUT" });
    if (response.ok) loadTasks();
    else alert("Failed to complete task");
}

function escapeHtml(str) {
    const div = document.createElement("div");
    div.textContent = str;
    return div.innerHTML;
}