<?php

require_once("db.php");
require_once("response.php");

// Create a new task
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $title = mysqli_real_escape_string($conn, $data['title']);
    $description = mysqli_real_escape_string($conn, $data['description']);

    $sql = "INSERT INTO todo (title, description) VALUES ('$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        sendResponse(['message' => 'Task created successfully']);
    } else {
        sendError('Error creating task');
    }
}


// Retrieve all todo
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM todo";
    $result = $conn->query($sql);

    $todo = [];

    while ($row = $result->fetch_assoc()) {
        $todo[] = $row;
    }

    sendResponse($todo);
}

// Retrieve a single task by ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM todo WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            sendResponse($result->fetch_assoc());
        } else {
            sendError('Task not found', 404);
        }

        $stmt->close();
    } else {
        sendError('Error retrieving task');
    }
}

// Update task by ID
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = json_decode(file_get_contents("php://input"), true);

    $title = mysqli_real_escape_string($conn, $data['title']);
    $description = mysqli_real_escape_string($conn, $data['description']);

    $sql = "UPDATE todo SET title = '$title', description = '$description' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        sendResponse(['message' => 'Task updated successfully']);
    } else {
        sendError('Error updating task');
    }
}

// Delete task by ID
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM todo WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            sendResponse(['message' => 'Task deleted successfully']);
        } else {
            sendError('Task not found', 404);
        }

        $stmt->close();
    } else {
        sendError('Error deleting task');
    }
}

$conn->close();

?>
