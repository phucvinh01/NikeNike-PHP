<?php
  session_start();
    include 'class/User.php';
    $errors_password_repeat = "";
    $errors_email_exist = "";
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_repeat = $_POST['password_repeat'];
        $user = new User();
        if($user->checkEmail($email)){
            $errors_email_exist = "Email alrealy exist, <a class ='text-primary'> You fogort password ?</a>";
        }
        else if($password != $password_repeat) {
            $errors_password_repeat = "Password not match";                   
        }
        else {
            $user_data = new User(0,$name,$email,$password,"","","");
            if($user->insertUser($user_data))
            {
                $_SESSION['user_data'] = $user_data;         
                header('location:index.php');
            
            }  
        }
    }
    if(isset($_SESSION['user_data'])){
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'ic/libary.php' ?>
    <title>Register</title>
</head>

<body>
<?php include 'ic/header.php'; ?>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>               
                <form class="mx-1 mx-md-4" method="POST" action="">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name ="name" require/>
                      <label class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control" name ="email" require/>
                      <label class="form-label" for="form3Example3c">Your Email</label>
                      <span class="text-danger"><?= $errors_email_exist ?></span>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" name ="password" require/>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control" name ="password_repeat" require/>
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                      <span class="text-danger"><?= $errors_password_repeat ?></span>
                    </div>
                  </div>

                  <!-- <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div> -->

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name ="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>

                </form>


              </div>
              <div class="col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://i.pinimg.com/564x/0f/79/8a/0f798a87b0bc61e8f8f679cf022e7a69.jpg"
                  class="img-fluid w-50" alt="Sample image" >
                  <img src="https://i.pinimg.com/564x/0f/79/8a/0f798a87b0bc61e8f8f679cf022e7a69.jpg"
                  class="img-fluid w-50" alt="Sample image" >
                  

              </div>
         

            </div>
            <a href="login.php" class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4 btn btn-outline-dark"><i class="fa-solid fa-arrow-left"></i></a>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'ic/footer.php' ?>