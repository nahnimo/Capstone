<?php
session_start();
include 'connection.php';


if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
$email = $_SESSION['email'];

$stmt = $conn->prepare("SELECT * FROM end_users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    // If the username does not exist, redirect to the login page
    header("Location: index.php");
    exit();
}
$row = $result->fetch_assoc();
?>