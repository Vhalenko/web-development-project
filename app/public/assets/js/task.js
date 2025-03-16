document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const taskId = this.getAttribute('data-task-id');
            const taskTitle = this.getAttribute('data-task-title');
            const taskPriority = this.getAttribute('data-task-priority');
            const taskDeadline = this.getAttribute('data-task-deadline');
            const taskDescription = this.getAttribute('data-task-description');

            document.getElementById('editTaskId').value = taskId;
            document.getElementById('editTaskTitle').value = taskTitle;
            document.getElementById('editPriority').value = taskPriority;
            document.getElementById('editDeadline').value = taskDeadline;
            document.getElementById('editTaskDescription').value = taskDescription;

            const editForm = document.getElementById('editTaskForm');
            editForm.action = `/edit-task/${taskId}`;

            document.getElementById('addTaskForm').style.display = 'none';
            document.querySelector('h2[for="addTaskForm"]').style.display = 'none'; 

            document.getElementById('editTaskForm').style.display = 'block';
            document.querySelector('h2[for="editTaskForm"]').style.display = 'block'; 
        });
    });

    document.querySelectorAll('.cancel-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('addTaskForm').style.display = 'block';
            document.querySelector('h2[for="addTaskForm"]').style.display = 'block'; 

            document.getElementById('editTaskForm').style.display = 'none';
            document.querySelector('h2[for="editTaskForm"]').style.display = 'none'; 
        });
    });
});