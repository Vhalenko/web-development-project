document.addEventListener('DOMContentLoaded', function() {
    // Handle the Edit button click event
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const taskId = this.getAttribute('data-task-id');
            const taskTitle = this.getAttribute('data-task-title');
            const taskPriority = this.getAttribute('data-task-priority');
            const taskDeadline = this.getAttribute('data-task-deadline');
            const taskDescription = this.getAttribute('data-task-description');

            // Fill the form fields with task data
            document.getElementById('editTaskId').value = taskId;
            document.getElementById('editTaskTitle').value = taskTitle;
            document.getElementById('editPriority').value = taskPriority;
            document.getElementById('editDeadline').value = taskDeadline;
            document.getElementById('editTaskDescription').value = taskDescription;

            // Dynamically set the form action
            const editForm = document.getElementById('editTaskForm');
            editForm.action = `/edit-task/${taskId}`;

            // Show the "Edit Task" form and header, hide "Add New Task"
            document.getElementById('addTaskForm').style.display = 'none';
            document.querySelector('h2[for="addTaskForm"]').style.display = 'none'; 

            document.getElementById('editTaskForm').style.display = 'block';
            document.querySelector('h2[for="editTaskForm"]').style.display = 'block'; 
        });
    });

    // Handle the Cancel button click event
    document.querySelectorAll('.cancel-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Show the "Add New Task" form and header, hide "Edit Task"
            document.getElementById('addTaskForm').style.display = 'block';
            document.querySelector('h2[for="addTaskForm"]').style.display = 'block'; 

            document.getElementById('editTaskForm').style.display = 'none';
            document.querySelector('h2[for="editTaskForm"]').style.display = 'none'; 
        });
    });
});
