<?php
session_start();
include 'class/User.php';
$user = new User();

$mess = "";
    if(isset($_POST['submit'])){
        $code = $_POST['code'];
        $email = $_SESSION['info'];
        if($user->checkCode($email,$code)){
            header('location: new_password.php');
        }
        else {
           $mess = "Code not match";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'ic/libary.php' ?>
    <title>Code Verification</title>
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
                            <div class="card-header h5 text-white " style="background-color: #F4C3C2;">Code Verification</div>

                            <div class="card-body px-5">
                                <form action="" method="post">
                                    <div class="form-outline">
                                        <input type="number" id="typeEmail" class="form-control my-3" name = "code" required/>
                                        <label class="form-label" for="typeEmail">Code input</label>
                                    </div>
                                    <button type="submit" name ="submit" class="btn btn-outline-dark w-100">Reset password</button>
                                </form>
                            </div>
                            <p class="text-danger text-center fs-3"><?= $mess ?></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-3"></div>
        </div>

    </div>


    <?php include 'ic/footer.php' ?>