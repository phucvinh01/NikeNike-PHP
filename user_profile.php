<?php session_start();
include 'class/User.php';
include 'class/Order.php';
include 'class/OrderDetail.php';
include 'class/Category.php';

$order = new Order();
$order_detail = new OrderDetail();
$cateId = new Category();
$order_data = $order->getHistoryOrderByUser($_SESSION['user_data']['Id']);

if (isset($_POST['submit'])) {
    $id = $_POST['Id'];
    $name  = $_POST['Name'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $phone = $_POST['Phone'];
    $address = $_POST['Address'];
    $image = $_FILES['image']['name'];

    $path = "uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $image_ext;

    $user = new User();
    $user_data = new User($id, $name, $email, $password, $phone, $address, $file_name);
    if ($user->UpdateUser($user_data) == true) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $file_name);
        //$_SESSION['user_data'] =  $user_data;
        header('location: user_profile.php');
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'ic/libary.php' ?>
    <title> <?= $_SESSION['user_data']['Name'] ?></title>
</head>
<style>
    label {
        cursor: pointer;
    }

    #upload-photo {
        opacity: 0;
        position: absolute;
        z-index: -1;
    }
</style>

<body>
    <?php include 'ic/header.php';
    ?>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row shadow p-3 mb-5 bg-body-tertiary rounded mt-5">
                <div class="col-5">
                    <div class="card-body text-center">
                        <img src="uploads/<?= $_SESSION['user_data']['Image'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;" />
                        <h5 class="my-3"><?= $_SESSION['user_data']['Name'] ?></h5>
                        <input class="btn btn-outline-primary ms-1" type="submit" value="Update Now" name="submit">
                        <label for="upload-photo" class="btn btn-outline-dark">Change Avatar</label>
                        <input type="file" name="image" id="upload-photo" />
                    </div>
                </div>
                <div class="col-7">
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
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded mt-5">
            <h3 class="fs-5">Lịch sử mua hàng</h3>
            <div class="row p-4">
                <div class="col-sm-8 col-md-8  col-lg-8 ">
                    <?php if (empty($order_data)) : ?>
                        <p class="fw-bold mb-1">Bạn chưa có order nào </p>
                    <?php else : ?>
                        <table class="table align-middle mb-0 bg-white text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Time Order</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order_data as $item => $value) :
                                    $products = $order_detail->getByOrder($value['Id']);
                                ?>
                                    <tr>
                                        <td>
                                            <?php foreach ($products as $item => $product) : ?>
                                                <div class="d-flex align-items-center">
                                                    <img src="uploads/<?= $product['Image'] ?>" alt="" style="width: 120px; height:120px" class="img-fluid rounded-3" />
                                                    <div class="ms-3">
                                                        <p class="fw-bold mb-1"><?= $product['Name'] ?></p>
                                                        <?php
                                                        $cateName = $cateId->findById($product['Category']);
                                                        ?>
                                                        <p class="text-muted mb-0"><?= $cateName[0] ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                            <?php endforeach; ?>
                                        </td>

                                        <td>
                                            <?php foreach ($products as $item => $product) : ?>
                                                <div class="d-flex align-items-center align-middle p-5">
                                                    <p class="fw-bold mb-1"><?= $product['quantity'] ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                        </td>
                                        <td>
                                            <p class="fw-bold mb-1"><?= $value['Day_order'] ?></p>
                                        </td>
                                        <td>
                                            <p class="fw-bold mb-1">$<?= number_format($value['Total_price'], 0, ',', '.') ?></p>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                </div>
            </div><?php endif; ?>
        </div>




        <?php include 'ic/footer.php' ?>