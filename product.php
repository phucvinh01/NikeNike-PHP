<?php session_start();
include 'class/Product.php';
include 'class/Category.php';
$pro = new Product();
$pro_list = $pro->getAllProducts();
$cateId = new Category();
if (!isset($_GET['cate'])) {
    $pro_list = $pro->getAllProducts();
}
if (isset($_GET['cate'])) {
    $pro_list = $pro->productForMen($_GET['cate']);
}


if (isset($_GET['sort'])) {

    if ($_GET['sort'] == "highttolow") {
        $pro_list = $pro->productSortHightLow();
    }
    if ($_GET['sort'] == "lowtohight") {

        $pro_list = $pro->productSortLowHight();
    }
}








?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'ic/libary.php' ?>
    <title>Product</title>
</head>

<body>
    <?php include 'ic/header.php' ?>
    <div class="container">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4 d-flex">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"> <a href="index.php" class="nav-link">Home</a></li>
                <li class="breadcrumb-item"> <a href="product.php" class="text-dark">Product</a></li>
                <?php if (isset($_GET['cate'])) :  ?>
                    <li class="breadcrumb-item active"> <a href="#" class="text-dark"><?= $_GET['cate'] ?></a> </li>
                <?php endif; ?>
            </ol>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort By
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="product.php?sort=lowtohight">Low - Hight</a></li>
                        <hr>
                        <li><a class="dropdown-item" href="product.php?sort=highttolow">Higth - Low</a></li>
                    </ul>
                </li>
            </ul>
        </nav>


        <div class="row container d-flex justify-content-center">
            <?php foreach ($pro_list as $key => $values) : ?>
                <div class="col-lg-4 col-md-4 col-md-6 p-3">
                    <a class="card" href="product-detail.php?id=<?= $values['Id']  ?>" style="text-decoration: none;">
                        <img src="uploads/<?= $values['Image'] ?>" style="height: 400px;" />
                        <div class="card-body">
                            <h5 class="card-title"><?= $values['Name'] ?></h5>
                            <?php
                            $cateName = $cateId->findById($values['Category']);
                            ?>
                            <p class="card-text text-muted"><?= $cateName[0]  ?></p>
                            <h5 class="card-title"><?= number_format($values['Price'], 0, ',', '.') ?> $</h5>

                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <?php include 'ic/footer.php' ?>