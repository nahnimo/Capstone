<?php
session_start();
include './connection.php';
include './session.php';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database for the user with the entered email
    $query = "SELECT * FROM end_users WHERE email='$email'";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Valid email, check password
        $user = mysqli_fetch_assoc($result);
        $hashed_password = $user['password'];

        if (password_verify($password, $hashed_password) && !empty($_POST['captcha'])) {
            // Valid password, set session variables and redirect to faqchat.php
            if ($_SESSION['secure'] == $_POST['captcha']) {

                echo "<script>alert('Valid captcha');
                    window.location.href='index.php';</script>";
                $_SESSION['user_id'] = $user['id'];
                header('Location: faqchat.php');
                exit;
            } elseif (empty($_POST['captcha'])) {
                echo "<script>alert('Captcha is empty');
                    window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Invalid captcha');
                    window.location.href='index.php';</script>";
            }

        } else {
            // Invalid password, show an error message
            echo "<script>alert('Wrong Password');
             window.location.href='index.php';</script>";

        }
    } else {
        // Invalid email, show an error messag
        echo "<script>alert('Invalid email');
        window.location.href='index.php';</script>";
    }

}
?>