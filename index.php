<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO App</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

    <div class="container">
        <header>
            <h1>TODO App</h1>
        </header>

        <section class="add-task">
            <h2>Add New Task</h2>
            <form id="addTaskForm">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" onclick="addTask(event)">Add Task</button>
            </form>
        </section>

        
        <div id="updateTaskModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeUpdateModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updateTaskForm">
                            <div class="form-group">
                                <label for="updateTitle">New Title:</label>
                                <input type="text" class="form-control" id="updateTitle" name="updateTitle" required>
                            </div>
                            <div class="form-group">
                                <label for="updateDescription">New Description:</label>
                                <textarea class="form-control" id="updateDescription" name="updateDescription" rows="4" required></textarea>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="submitUpdate()">Update Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section class="tasks">
            <h2>Your Tasks</h2>
            <div id="tasksContainer"></div>
        </section>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
