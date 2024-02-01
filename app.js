document.addEventListener("DOMContentLoaded", function () {
    const addTaskForm = document.getElementById('addTaskForm');
    const tasksContainer = document.getElementById('tasksContainer');
    const updateTaskModal = document.getElementById('updateTaskModal');

    updateTaskModal.style.display = 'none';

    function fetchTasks() {
        fetch('http://localhost/todo/tasks.php')
            .then(response => response.json())
            .then(tasks => displayTasks(tasks))
            .catch(error => console.error('Error fetching tasks:', error));
    }

    function addTask(event) {
        event.preventDefault();

        const title = document.getElementById('title').value;
        const description = document.getElementById('description').value;

        fetch('http://localhost/todo/tasks.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ title, description }),
        })
            .then(response => response.json())
            .then(result => {
                console.log(result);
                fetchTasks();
                document.getElementById('title').value = '';
                document.getElementById('description').value = '';
            })
            .catch(error => console.error('Error adding task:', error));
    }

    function displayTasks(tasks) {
        tasksContainer.innerHTML = '';

        tasks.forEach(task => {
            const taskElement = document.createElement('div');
            taskElement.classList.add('task', 'card', 'mt-2');
            taskElement.innerHTML = `
                <div class="card-body">
                    <h5 class="card-title">${task.title}</h5>
                    <p class="card-text">${task.description}</p>
                    <button class="btn btn-info" onclick="openUpdateModal(${task.id})">Update</button>
                    <button class="btn btn-danger" onclick="deleteTask(${task.id})">Delete</button>
                </div>
            `;
            tasksContainer.appendChild(taskElement);
        });
    }

    window.openUpdateModal = function (taskId) {
        fetch(`http://localhost/todo/tasks.php?id=${taskId}`)
            .then(response => response.json())
            .then(task => {
                if (task) {
                    document.getElementById('updateTitle').value = task.title || '';
                    document.getElementById('updateDescription').value = task.description || '';
                    updateTaskModal.dataset.taskId = taskId;
                    $('#updateTaskModal').modal('show');
                } else {
                    console.error('Task details are undefined.');
                }
            })
            .catch(error => console.error('Error fetching task details:', error));
    };

    window.closeUpdateModal = function () {
        updateTaskModal.style.display = 'none';
    };

    window.submitUpdate = function () {
        const updateTitle = document.getElementById('updateTitle').value;
        const updateDescription = document.getElementById('updateDescription').value;
        const taskId = updateTaskModal.dataset.taskId;

        fetch(`http://localhost/todo/tasks.php?id=${taskId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ title: updateTitle, description: updateDescription })
        })
            .then(response => response.json())
            .then(result => {
                console.log(result);
                closeUpdateModal();
                window.location.href = 'http://localhost/todo';
            })
            .catch(error => console.error('Error updating task:', error));
    };

    window.deleteTask = function (taskId) {
        const confirmDelete = confirm('Are you sure you want to delete this task?');

        if (confirmDelete) {
            fetch(`http://localhost/todo/tasks.php?id=${taskId}`, {
                method: 'DELETE',
            })
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    fetchTasks();
                })
                .catch(error => console.error('Error deleting task:', error));
        }
    };

    addTaskForm.addEventListener('submit', addTask);

    fetchTasks();
});
