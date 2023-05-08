<?php
include 'connection.php';

if (!isset($_SESSION['email'])) {
    // User is not logged in, redirect to index.php
    header('Location: index.php');
    exit;
} else {
    $user_email = $_SESSION['email'];
    $query = "SELECT * FROM end_users WHERE email = '$user_email'";
    $result = mysqli_query($connect, $query);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        // User email does not exist in the database, redirect to index.php
        header('Location: index.php');
        exit;
    }

    // Now you can use $user['email'] or $user['password'] to check the user's information
}
?>