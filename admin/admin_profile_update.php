<?php
 include '../class/User.php';
session_start();
$user = new User();

$admin_email = $_SESSION['admin_email'];
if (!isset($admin_email)) {
  header('location:admin_login.php');
}

if (isset($_POST['submit'])) {
  $Id = $_POST['Id'];
  $Name = $_POST['Name'];
  $Email = $_POST['Email'];
  $Phone = $_POST['Phone'];
  $Address = $_POST['Address'];
  $Password = $_POST['Password'];
  $Image = $_POST['Image'];
  $user_data = new User($Id, $Name, $Email,$Password, $Phone, $Address, $Image);
  $user = new User();
  $user->UpdateUser($user_data);
  header("location: admin_profile.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'ic/libary.php'; ?>
  <title>Admin - Profile - Update</title>
</head>
<style>
  .input-filed {
    border: none;
  }
</style>

<body>
  <?php include 'ic/admin_header.php'; ?>
  <section style="background-color: #eee;">
    <div class="container py-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="admin_profile.php">User Profile</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile - Update</li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <form method="POST" action="">
              <div class="card-body text-center">
                <img src="<?= $_SESSION['user_data']['Image'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                <h5 class="my-3"><?= $_SESSION['user_data']['Name'] ?></h5>
                <p class="text-muted mb-1">Full Stack Developer</p>
                <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                <input class="btn btn-outline-primary ms-1" type="submit" value="Update Now" name="submit">
              </div>
          </div>

          <div class="card mb-4 mb-lg-0">
            <div class="card-body p-0">
              <ul class="list-group list-group-flush rounded-3">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fa-brands fa-github" style="color: #1c2c45;"></i>
                  <a class="mb-0" href="https://github.com/phucvinh01">My git</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fa-brands fa-instagram"></i>
                  <a class="mb-0" href="https://www.instagram.com/viinh_0/">Instagram</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fa-brands fa-facebook"></i>
                  <a class="mb-0" href="https://www.facebook.com/viinnh02">Facebook</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                  <input type="hidden" name="Id" value="<?= $_SESSION['user_data']['Id'] ?>">
                  <input class="text-muted mb-0 w-100 p-1 input-filed" type="text" value="<?= $_SESSION['user_data']['Name'] ?>" name="Name" require>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <input class="text-muted mb-0 w-100 p-1 input-filed" type="email" value="<?= $_SESSION['user_data']['Email'] ?>" name="Email" require>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Password</p>
                </div>
                <div class="col-sm-9">
                  <input class="text-muted mb-0 w-100 p-1 input-filed" type="password" value="<?= $_SESSION['user_data']['Password'] ?>" name="Password" require>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                  <input class="text-muted mb-0 w-100 p-1 input-filed" type="tel" value="<?= $_SESSION['user_data']['Phone'] ?>" name="Phone" require>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                  <input class="text-muted mb-0 w-100 p-1 input-filed" type="text" value="<?= $_SESSION['user_data']['Address'] ?>" name="Address" require>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Image</p>
                </div>
                <div class="col-sm-9">
                  <input class="text-muted mb-0 w-100 p-1  input-filed" type="text" value="<?= $_SESSION['user_data']['Image'] ?>" name="Image" require>
                </div>
              </div>
            </div>
          </div>
          </form>
          <div class="row pt-3">
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                  </p>
                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                  </p>
                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <?php include 'ic/admin_footer.php'; ?>