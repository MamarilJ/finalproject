<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $todo_item = $_POST['todo_item'];

    $stmt = $conn->prepare("INSERT INTO todos (user_id, todo_item) VALUES (:user_id, :todo_item)");
    $stmt->execute(['user_id' => $user_id, 'todo_item' => $todo_item]);

    header('Location: index.php');
}
?>
