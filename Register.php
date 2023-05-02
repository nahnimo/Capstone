<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        form {
            max-width: 40%;
            margin: 0 auto;
        }
        input[type=text], input[type=email], input[type=password] {
            width: 100%;
            padding: 12px;
            margin: 6px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }
        button[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type=button] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
   <?php
include('connection.php');

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $error_msg = "";
    if (trim($username) === '') {
        $error_msg = "Username cannot be empty or contain only spaces.";
    }


    if (!preg_match('/^[a-zA-Z0-9@.\s-]+$/', $email)) {
        // Invalid character in email input
        $error_msg = "Invalid character in email input. Only letters, digits, @, ., -, and spaces are allowed.";
    } else {
        // Sanitize the email input
        $sanitized_email = preg_replace('/^[a-zA-Z0-9@.\s-]+$/', '', $email);
    }

    // Check if the username already exists in the database
    $query_check = "SELECT * FROM end_users WHERE email = '$email'";
    $result_check = mysqli_query($connect, $query_check);

    if(mysqli_num_rows($result_check) > 0) {
        $error_msg .= "Username already exists!";
    }

    if(empty($error_msg)) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if passwords match
        if($password != $confirm_password) {
            $error_msg .= "Passwords do not match!";
        } else {
            // Hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user into the database
            $query_insert = "INSERT INTO end_users (username, email, password) VALUES ('$username', '$email', '$password')";
            $result_insert = mysqli_query($connect, $query_insert);

            if($result_insert) {
                // Display success message and redirect to index.php
                echo "Account created successfully!";
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

    // Display error message as an alert box
    if(!empty($error_msg)) {
        echo "<script>alert('$error_msg');</script>";
    }
}
?>



    <form method="post" action="register.php">
    <h2>Registration Form</h2>
    <label for="name">Name</label>
    <input type="text" id="username" name="username" placeholder="your_name" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder ="email@example.com"  required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="*********" required>

    <label for="confirm_password">Confirm Password</label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="*********" required>

    <button type="submit" name="register">Register</button>
    <br>
    <button type="button" onclick="location.href='index.php';">Already have an Account?</button>
</form>


</body>
</html>