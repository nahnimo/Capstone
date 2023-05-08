<?php
session_start();
include('connection.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = "6Lf9f_AlAAAAAOfUsVw9soZxggvHB_n5uy2eZANW";
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $captcha . '&remoteip=' . $ip;

    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);


    // Query the database for the user with the entered email
    $query = "SELECT * FROM end_users WHERE email='$email'";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0 && $responseKeys["success"]) {
        // Valid email, check password
        $user = mysqli_fetch_assoc($result);
        $hashed_password = $user['password'];

        if (password_verify($password, $hashed_password)) {
            // Valid password, set session variables and redirect to faqchat.php
                $_SESSION['email'] = $email;
                header('Location: faqchat.php');
                exit;

        } else {
            // Invalid password, show an error message
            echo "<script>alert('Error 101');
             window.location.href='index.php';</script>";

        }
    } else {
        // Invalid email, show an error messag
        echo "<script>alert('Error talaga');
        window.location.href='index.php';</script>";
    }

}
?>