<?php
session_start();
include 'class/User.php';
$mess = "";
$user = new User();
    if(isset($_POST['submit'])){
        $password = $_POST['password'];
        $password_comfrim = $_POST['password-comfrim'];
        $email = $_SESSION['info'];
        if($password == $password_comfrim) {
            if($user->updatePassword($email,$password)){
                header('location: login.php');
            }
        }
        else{
            $mess = "Password not match";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'ic/libary.php' ?>
    <title>New Password</title>
</head>

<body>
    <?php include 'ic/header.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-md-6 p-5">
                <div class="row">
                    <div class="col-4">
                        <img src="https://i.pinimg.com/236x/97/d0/08/97d008fdfb8114e7637a24db7004f44c.jpg" alt="" srcset="" class="card-img-top w-100">
                    </div>
                    <div class="col-8">
                        <div class="card text-center">
                            <div class="card-header h5 text-white " style="background-color: #F4C3C2;">New Password</div>

                            <div class="card-body px-5">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="password" id="typeEmail" class="form-control my-3" name = "password" />
                                        <label class="form-label" for="typeEmail">New password</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="typeEmail" class="form-control my-3" name = "password-comfrim" />
                                        <label class="form-label" for="typeEmail">Cofrim password</label>
                                    </div>
                                    <button type="submit" name ="submit" class="btn btn-outline-dark w-100">Change Password</button>
                                </form>
                                <p class="text-danger fs-3 text-center"><?= $mess ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-3"></div>
        </div>

    </div>


    <?php include 'ic/footer.php' ?>