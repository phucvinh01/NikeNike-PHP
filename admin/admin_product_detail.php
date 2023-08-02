<?php
session_start();
include '../class/Product.php';


$id = $_GET['id'];

$product = new Product();
$product_data = $product->getOneProductByID($id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'ic/libary.php'; ?>
    <title>Admin - Product - Detail</title>
</head>
<style>
    .main_image {
        width: 350px;
    }

    .img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        max-height: 500px;
    }
</style>

<body>
    <?php include_once 'ic/admin_header.php' ?>
    <div class="container-fluid mt-5 mb-5 row">
        <?php foreach ($product_data as $item) : ?>
            <div class="col-2">
                <?php include_once 'ic/admin_sidebar.php' ?>
            </div>
            <div class="col-10">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item "><a href="admin_product.php">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $item['Name'] ?></li>
                    </ol>
                </nav>
                <div class="card shadow-sm p-3 mb-5 bg-white rounded m-4">
                    <div class="row g-0">
                        <div class="col-md-6 border-end">
                            <img class="w-100 img" src="../uploads/<?= $item['Image'] ?>" id="main_product_image">
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 right-side">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3><?= $item['Name'] ?></h3> <span class="heart"><i class='bx bx-heart'></i></span>
                                </div>
                                <div class="mt-2 pr-3 content">
                                    <p><?= $item['Description'] ?></p>
                                </div>
                                <h3>$ <?= number_format($item['Price'], 0, ',', '.')  ?></h3>
                                <div class="ratings d-flex flex-row align-items-center">
                                    <div class="d-flex flex-row"> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bx-star'></i> </div> <span>441 reviews</span>
                                </div>
                                <div class="buttons d-flex flex-row mt-5 gap-3">
                                    <a class="btn btn-outline-dark" href="admin_edit_product.php?id=<?= $item['Id'] ?>">Edit</a>
                                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                </div>

                            </div>
                        </div>

                   
                    </div>
                </div>

            </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Announcement</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure delele Product</strong>  <em><?=$item['Name'] ?> </em>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                    <a type="button" href="admin_product_delete.php?id=<?=$item['Id'] ?>" class="btn btn-outline-danger">Sure</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    </div>








    <?php include_once 'ic/admin_footer.php' ?>