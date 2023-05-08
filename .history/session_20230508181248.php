<?php
session_start();
include './connection.php';


if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
$username = $_SESSION['email'];

$stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    // If the username does not exist, redirect to the login page
    header("Location: admin.php");
    exit();
}
$row = $result->fetch_assoc();
?>