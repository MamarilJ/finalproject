<?php
$host = 'localhost';
$dbname = 'todolist_app';
$user = 'root'; // Adjust this based on your server setup
$pass = ''; // Adjust this based on your server setup

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
