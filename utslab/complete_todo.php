<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $todo_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE todos SET status = 'completed' WHERE id = ? AND user_id = ?");
    $stmt->execute([$todo_id, $user_id]);

    header("Location: dashboard.php");
    exit();
}
?>
