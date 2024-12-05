<?php
require 'db.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the todo_id from the form submission
    $todo_id = $_POST['todo_id'];

    // Prepare the DELETE statement to remove the to-do item
    $stmt = $conn->prepare("DELETE FROM todos WHERE id = :todo_id AND user_id = :user_id");
    $stmt->execute([
        'todo_id' => $todo_id,
        'user_id' => $_SESSION['user_id']
    ]);

    // Redirect back to the to-do list page after deletion
    header('Location: index.php');
    exit();
}
?>
