<?php
require 'db.php';
session_start();

// Redirect to login if user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the user's todos from the database, including the 'completed' status
$stmt = $conn->prepare("SELECT * FROM todos WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        nav {
            background-color: #333;
            padding: 10px;
            margin-bottom: 20px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-start;
        }
        nav ul li {
            margin-right: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            padding: 10px 15px;
            display: inline-block;
        }
        nav ul li a:hover {
            text-decoration: underline;
            background-color: #555;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        form {
            display: inline;
        }
        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button.delete {
            background-color: #dc3545;
        }
        button.complete {
            background-color: #007bff;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .completed {
            text-decoration: line-through;
            color: #888;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>Your To-do List</h2>

    <!-- Display message when there are no to-do items -->
    <?php if (empty($todos)): ?>
        <p>You have no to-dos yet! Add your first task below:</p>
    <?php else: ?>
        <ul>
            <?php foreach ($todos as $todo): ?>
                <li class="<?= $todo['completed'] ? 'completed' : '' ?>">
                    <?= htmlspecialchars($todo['todo_item']) ?>
                    
                    <!-- Mark as Complete Button (only if not already completed) -->
                    <?php if (!$todo['completed']): ?>
                        <form method="POST" action="complete_todo.php" style="display:inline;">
                            <input type="hidden" name="todo_id" value="<?= $todo['id'] ?>">
                            <button type="submit" class="complete">Mark as Complete</button>
                        </form>
                    <?php endif; ?>

                    <!-- Delete Button -->
                    <form method="POST" action="delete_todo.php" style="display:inline;">
                        <input type="hidden" name="todo_id" value="<?= $todo['id'] ?>">
                        <button type="submit" class="delete">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- Form to add new to-do -->
    <form method="POST" action="add_todo.php">
        <input type="text" name="todo_item" placeholder="New To-do" required>
        <button type="submit">Add To-do</button>
    </form>

    <!-- Logout link -->
    <p><a href="logout.php">Logout</a></p>

</body>
</html>
