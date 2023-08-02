<?php session_start();
include_once '../class/Product.php';
$pro = new Product();
$list_pro = $pro->getAllProducts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'ic/libary.php'; ?>
    <title>Admin - Product</title>
</head>
<style>
    .size {
        height: 300px;
        width: 300px;

    }
</style>

<body>
    <?php include_once 'ic/admin_header.php' ?>
    <div class="row container ">
        <div class="col-3">
            <?php include_once 'ic/admin_sidebar.php' ?>
        </div>
        <div class="col-9">
            <div class="d-flex justify-content-end">
                <a href="admin_insert_product.php" class="btn btn-outline-primary p-1 m-3"> Insert New Product </a>
            </div class="d-flex justify-content-end">
                <p>Count: <?= count($list_pro) ?></p>
            <div>

            </div>
            <div class="row" style="background-color: #eee;">
            <?php if($list_pro == true) : ?>
                <?php foreach ($list_pro as $item => $key) : ?>
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black mt-3">
                            <img src="../uploads/<?= $key['Image'] ?>" class="card-img-top img-thumbnail size" alt="Apple Computer" />
                            <div class="card-body">
                                <div class="text-start">
                                    <h5 class="card-title"><?= $key['Name'] ?></h5>
                                </div>
                                <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                    <span>Price:</span><span>$<?= $key['Price'] ?></span>
                                </div>
                                <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                    <a href="admin_product_detail.php?id=<?=$key['Id'] ?>" class="btn btn-outline-primary w-100">View</a>
                                    <!-- <a href="#" class="btn btn-outline-light"><i class="fa-solid fa-cart-shopping" style="color: #6889ee;"></i></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;  ?>
                <?php else: ?>
                    <p>List Product is empty</p>
                <?php endif; ?>
            </div>
        </div>
    </div>




    <?php include_once 'ic/admin_footer.php' ?>