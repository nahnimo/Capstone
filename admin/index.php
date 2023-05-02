<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link rel="stylesheet" href="login.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="stylesheet.css"/>-->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>
<body >
<form action="login.php" method="POST" class="login">
    
           <section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>

            <div class="form-outline mb-4">
              <input type="text" name="username" id="typeEmailX-2" class="form-control form-control-lg" />
              <label class="form-label" for="typeEmailX-2">Username</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" name="password" id="typePasswordX-2" class="form-control form-control-lg" />
              <label class="form-label" for="typePasswordX-2">Password</label>
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-start mb-4">
            <input class="form-check-input" type="checkbox" value="on" id="form1Example3" name="remember_me"/>
            <label class="form-check-label" for="form1Example3"> Remember password </label>
          </div>


            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block"></input>

            <hr class="my-4">
            <?php
session_start();
include('connection.php');

// Check if the "Remember Me" cookie is set and valid
if (isset($_COOKIE['remember_me'])) {
    $userId = $_COOKIE['remember_me'];
    $query = "SELECT * FROM users WHERE id='$userId'";
    $result = mysqli_query($connect, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        // Valid cookie, set session variables and redirect to index.php
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['submit'])) {
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user with the entered email and password
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Valid credentials, set session variables and cookie (if "Remember Me" was checked)
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
            $userId = $user['id'];
            setcookie('remember_me', $userId, time() + 60*60*24*30); // 30 days
        }
        header('Location: index.php');
        exit;
    } else {
        // Invalid credentials, show an error message
        $error_msg = "Invalid email or password.";
    }
}

?>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
</body>
</html>
