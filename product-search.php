<?php session_start();
include 'class/Product.php';
include 'class/Category.php';
$pro = new Product();
$cateId = new Category();
$pro_list = $pro->getAllProducts();

if (isset($_POST['submit'])) {
    $data = $_POST['search'];
    $return_data = $pro->searchProducts($data);
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
                <li class="breadcrumb-item active"> Product </a></li>
            </ol>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort By
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Low - Hight</a></li>
                        <hr>
                        <li><a class="dropdown-item" href="#">Higth - Low</a></li>
                    </ul>
                </li>
            </ul>
        </nav>


        <div class="row container d-flex justify-content-center">
            <?php if (!isset($return_data)) : ?>
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
            <?php else : ?>
                <h2>Result for: <?= $data ?></h2>
                <?php foreach ($return_data as $key => $values) : ?>
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
            <?php endif; ?>

        </div>
    </div>


    <?php include 'ic/footer.php' ?>