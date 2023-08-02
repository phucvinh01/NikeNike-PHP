<?php
session_start();
include_once 'class/Connection.php';
include_once 'class/User.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'ventor/PHPMailer-master/src/Exception.php';
require 'ventor/PHPMailer-master/src/PHPMailer.php';
require 'ventor/PHPMailer-master/src/SMTP.php';
$user = new User();
$mess = "";
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  if ($user->checkLogin($email, $password)) {
    session_start();
    $_SESSION['user_data'] = $user->findUserByEmail($email);
    $role_as = $_SESSION['user_data']['role'];
    //var_dump($role_as);
    if ($role_as == 1) {
      $_SESSION['admin_email'] = $email;
      header('Location: admin/admin_dashboard.php');
    } else {
      header('location: index.php');
    }
  } else {
    $mess = "Incorrect email or password!";
  }
}


if (isset($_POST['reset'])) {
  $email = $_POST['email'];
  $code = rand(999999, 111111);
  if ($user->checkEmail($email)) {
    $_SESSION['info'] = $email;
    if ($user->updateToken($email, $code)) {
      $mail = new PHPMailer;
      $mail->isSMTP();
      $mail->Host = 'smtp.elasticemail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'nguyenphucvinh1920@gmail.com';
      $mail->Password = '85F6B83ADBCBEB83397D94DC3830DD052240';
      $mail->Port = 2525;

      $mail->From = 'vn150746@gmail.com';
      $mail->FromName = 'Let reset your password';
      $mail->addAddress($email);

      $mail->isHTML(true);

      $mail->Subject = 'Email Verification Code';
      $mail->Body    = "Your verification code is $code";
      $mail->AltBody = 'From: vn150746@gmail.com';
      if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
        echo 'Message has been sent';
        header('location: reset_password.php');
      }
    }
    else {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Holy guacamole!</strong> Something wrong!!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Holy guacamole!</strong> Email exist!!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'ic/libary.php' ?>
  <title>Login </title>
</head>

<body>
  <?php include_once 'ic/header.php'; ?>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://i.pinimg.com/564x/28/1c/7a/281c7ab1a58fe4ac4b972a54be5221b6.jpg" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form method="POST" action="">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Nike - Nike</span>
                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                    <div class="form-outline mb-4">
                      <input type="email" id="form2Example17" class="form-control form-control-lg" name="email" />
                      <label class="form-label" for="form2Example17">Email address</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>
                    <span class="text-danger fs-3 text-center"><?= $mess ?></span>
                    <div class="pt-1 mb-4">
                      <button class="btn btn-outline-dark btn-lg btn-block w-50" type="submit" name="submit">Login</button>
                    </div>
                    <div class="row justify-content-center align-items-center">
                      <p><a class="small text-muted" data-bs-toggle="modal" data-bs-target="#exampleModal" href="reset_password.php">Forgot password?</a></p>
                      <br>
                      <p style="color: #393f81;">Don't have an account? </p>
                      <br>
                      <p> <a href="register.php" style="color: #393f81;">Register here</a></p>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal top fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
      <div class="modal-dialog" style="width: 300px;">
        <div class="modal-content text-center">
          <div class="modal-header h5 text-white justify-content-center" style="background-color: #F4C3C2;">
            Password Reset
          </div>
          <form action="" method="post">
            <div class="modal-body px-5">
              <p class="py-2">
                Enter your email address and we'll send you an email with instructions to reset your password.
              </p>
              <div class="form-outline">
                <input type="email" id="typeEmail" class="form-control my-3" name="email" />
                <label class="form-label" for="typeEmail">Email input</label>
              </div>
              <button href="#" type="submit" name="reset" class="btn btn-outline-dark w-100">Reset password</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'ic/footer.php' ?>