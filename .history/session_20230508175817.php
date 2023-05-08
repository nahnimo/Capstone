<?php
session_start();
include './connection.php';

if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to index.php
    header('Location: index.php');
    exit;
}

$user_email = $_SESSION['email'];
$query = "SELECT * FROM end_users WHERE username = '$user'";
$result = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($result);


?>