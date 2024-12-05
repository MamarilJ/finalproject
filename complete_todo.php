<?php
require 'db.php';
session_start();

// Ensure the user is authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$todo_id = $_POST['todo_id'];

// Mark the task as completed
$stmt = $conn->prepare("UPDATE todos SET completed = 1 WHERE id = :todo_id AND user_id = :user_id");
$stmt->execute(['todo_id' => $todo_id, 'user_id' => $user_id]);

// Redirect back to the todo list
header('Location: index.php');
exit();
?>
