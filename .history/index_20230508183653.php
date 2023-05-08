<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Log in</title>
  <link rel="stylesheet" href="login.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!--<link rel="stylesheet" href="stylesheet.css"/>-->
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body>
  <form action="login.php" method="POST" class="login">

    <section class="vh-100" style="background-color: #508bfc;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <h3 class="mb-5">Sign in</h3>

                <div class="form-outline mb-4">
                  <input type="email" name="email" id="typeEmailX-2" class="form-control form-control-lg" autofocus />
                  <label class="form-label" for="typeEmailX-2" >Username</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" name="password" id="typePasswordX-2" class="form-control form-control-lg" />
                  <label class="form-label" for="typePasswordX-2">Password</label>
                </div>

                

                <div id='ae_captcha_api'></div>
                <br>
                <div>
                  <input type="text" placeholder="Enter Captcha" name="captcha" />
                </div>
                <br>
                <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block"></input>

                <hr class="my-4">
                <button type="button" onclick="location.href='Register.php';">Dont have an Account?</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
  <script src="./captcha-generator/asset/main.js"></script>
</body>

</html>