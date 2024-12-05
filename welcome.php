<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the to-do list page if already logged in
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Welcome to Your To-do List App</h2>
    <p>Choose an option to continue:</p>

    <!-- Login and Register buttons -->
    <a href="login.php"><button class="button">Login</button></a>
    <a href="register.php"><button class="button">Register</button></a>
</body>
</html>
