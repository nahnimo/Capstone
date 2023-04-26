<?php
session_start();
include('connection.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database for the user with the entered email and password
    $query = "SELECT * FROM end_users WHERE email='$email'";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Valid credentials, check if 2FA is enabled for the user
            if ($user['2fa_enabled'] == 1) {
                // 2FA is enabled, generate a random code and send it to the user's registered email
                $code = rand(100000, 999999);
                $to = $user['email'];
                $subject = '2FA Code';
                $message = "Your 2FA code is: $code";
                $headers = 'From: webmaster@example.com' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                if (mail($to, $subject, $message, $headers)) {
                    // 2FA code sent successfully, store the code in the session and redirect to the 2FA verification page
                    $_SESSION['2fa_code'] = $code;
                    $_SESSION['2fa_user_id'] = $user['id'];
                    header('Location: 2fa_verification.php');
                    exit;
                } else {
                    // Failed to send the email, show an error message
                    $error_msg = "Failed to send 2FA code.";
                }
            } else {
                // 2FA is not enabled, set session variables and redirect to index.php
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                header('Location: index.php');
                exit;
            }
        } else {
            // Invalid password, show an error message
            $error_msg = "Invalid email or password.";
        }
    } else {
        // User not found, show an error message
        $error_msg = "Invalid email or password.";
    }
}
?>
