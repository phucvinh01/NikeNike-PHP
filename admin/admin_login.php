<?php
include '../class/connection.php';
include '../class/User.php';
session_start();
$user = new User();
$mess = "";

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($user->checkAdminLogin($email, $password)) {
    $_SESSION['admin_email'] = $email;
    //var_dump($_SESSION['admin_email']);
    $user_data = $user->findUserByEmail($admin_email);
    $_SESSION['user_data'] =  $user_data;
    header('location:admin_dashboard.php');
  } else {
    $mess = "Incorrect email or password!";
  }
}







?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'ic/libary.php'; ?>
  <title>Login - Admin</title>
</head>

<body>
  <section class="vh-100">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 text-black">

          <div class="px-5 ms-xl-4">
            <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
            <span class="h1 fw-bold mb-0">Logo</span>
          </div>

          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

            <form style="width: 30rem;" method="POST" action="">

              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

              <div class="form-outline mb-4">
                <input type="email" id="email" class="form-control form-control-lg" name="email" require />
                <label class="form-label" for="email">Email address</label>
                <span class="text-danger text-munted"><?= $mess ?></span>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="password" class="form-control form-control-lg" name="password" require />
                <label class="form-label" for="password">Password</label>
                <span class="text-danger text-munted"><?= $mess ?></span>
              </div>

              <div class="pt-1 mb-4">
                <input class="btn btn-info btn-lg btn-block" type="submit" value="login now" name="submit">
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
              <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p>

            </form>

          </div>

        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="https://images.pexels.com/photos/7473030/pexels-photo-7473030.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>