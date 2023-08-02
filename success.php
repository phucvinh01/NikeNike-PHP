<?php
session_start();
include 'class/Cart.php';
include 'class/Category.php';
include 'class/Order.php';
include 'class/OrderDetail.php';
$cart = new Cart();
$order = new Order();
$order_detail = new OrderDetail();

$id_order = $_GET['id'];

if (isset($_SESSION['user_data'])) {
    $order_data = $order->getByIdUser($_SESSION['user_data']['Id'], $id_order);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'ic/libary.php' ?>
    <title>Thank You .Nike - Nike</title>
</head>

<body>
    <?php include 'ic/header.php' ?>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100 text-center">
                <div class="col">
                    <!-- Button trigger modal -->
                    <p class="fs-1">Thank you for order</p>
                    <button type="button" class="btn btn-outline-dark btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-info me-2"></i> Get information
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start text-black p-4">
                                    <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel">Nike Nike</h5>
                                    <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
                                    <p class="mb-0" style="color: #35558a;">Your Order</p>
                                    <hr class="mt-2 mb-4" style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                                    <?php foreach ($order_data as $item => $value) : ?>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <img src="uploads/<?= $value['Image'] ?>" class="img-fluid rounded-3" style="width: 120px;" alt="Book">
                                            <p class="fw-bold mb-0"><?= $value['Name'] ?></p>
                                            <p class="fw-bold mb-0"><?= $value['quantity'] ?></p>
                                        </div>

                                    <?php endforeach; ?>
                                    <hr class="mt-2 mb-4" style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                                    <p class="mb-0" style="color: #35558a;">Payment summary</p>
                                    <div class="d-flex justify-content-between">
                                        <p class="small mb-0">Shipping</p>
                                        <p class="small mb-0">$30.000</p>
                                    </div>


                                    <div class="d-flex justify-content-between">
                                        <p class="fw-bold">Total</p>
                                        <p class="fw-bold" style="color: #35558a;">$<?= number_format($order_data[0]['Total_price'], 0, ',', '.')  ?></p>
                                    </div>
                                    <p class="mb-0 text-start" style="color: #35558a;">Your Address</p>
                                    <hr class="mt-2 mb-4" style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                                    <div class="">
                                        <p class="fw-bold mb-0">Name:<?= $order_data[0]['FullName'] ?></p>
                                        <p class="fw-bold mb-0">Phone:<?= $order_data[0]['Number'] ?></p>
                                        <p class="fw-bold mb-0">Address:<?= $order_data[0]['Address'] ?></p>
                                        <p class="fw-bold mb-0">Day:<?= $order_data[0]['Day_order'] ?></p>
                                        <p class="fw-bold mb-0">Payment:<?= $order_data[0]['Payment_status'] ?></p>


                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <?php include 'ic/footer.php' ?>