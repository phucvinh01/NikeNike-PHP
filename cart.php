<?php session_start();
include 'class/Cart.php';
include 'class/Category.php';
$cart = new Cart();
if (isset($_SESSION['user_data'])) {
    $cart_data = $cart->get($_SESSION['user_data']['Id']);
    $_SESSION['count_cart'] = count($cart_data);
}


$cateId = new Category();

if (isset($_POST['submit'])) {
    $qty = $_POST['quantity'];
    $pro_id = $_POST['id_pro'];
    $cart->update($_SESSION['user_data']['Id'], $qty, $pro_id);
    if ($qty == 0) {
        $cart->delete($_SESSION['user_data']['Id'], $pro_id);
        $_SESSION['count_cart'] = count($cart_data);
    }
    $cart_data = $cart->get($_SESSION['user_data']['Id']);
}

if (isset($_POST['delete'])) {
    $pro_id = $_POST['id_pro'];
    $cart->delete($_SESSION['user_data']['Id'], $pro_id);
    $cart_data = $cart->get($_SESSION['user_data']['Id']);
    $_SESSION['count_cart'] = count($cart_data);
}
//var_dump($cart_data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'ic/libary.php' ?>
    <title>Bag. Nike Nike Store</title>
</head>

<body>
    <?php include_once 'ic/header.php' ?>

    <div class="container">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4 d-flex">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"> <a href="index.php" class="nav-link">Home</a></li>
                <li class="breadcrumb-item active"> Your Bag </a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-8 col-md-8  col-lg-8 ">
                <?php if (empty($cart_data)) : ?>
                    <img src="https://i.pinimg.com/564x/46/50/d5/4650d5bc29c87da0a6d1cde8fd512d58.jpg" alt="" srcset="" class="img-fluid rounded-3 w-100">
                <?php else : ?>
                    <table class="table align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            $total = 0;
                            $sub_total = 0;
                            foreach ($cart_data as $item => $value) : ?>
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="uploads/<?= $value['Image'] ?>" class="img-fluid rounded-3" style="width: 120px;" alt="Book">
                                            <div class="flex-column ms-4">
                                                <p class="mb-2"><?= $value['Name'] ?></p>
                                                <?php
                                                $cateName = $cateId->findById($value['Category']);
                                                ?>
                                                <p class="card-text text-muted"><?= $cateName[0] ?></p>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="align-middle">
                                        <form action="" method="post">
                                            <div class="d-flex flex-row">
                                                <button type="submit" name="submit" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="hidden" name="id_pro" value=" <?= $value['Id'] ?>">
                                                <input id="form1" min="0" name="quantity" value="<?= $value['Quantity'] ?>" type="number" class="form-control form-control-sm" style="width: 50px;" />

                                                <button type="submit" name="submit" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="align-middle">
                                        <p class="mb-0" style="font-weight: 500;"> $ <?= number_format($value['Price'], 0, ',', '.') ?></p>
                                    </td>
                                    <td class="align-middle">
                                        <form action="" method="post">
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <input type="hidden" name="id_pro" value=" <?= $value['Id'] ?>">
                                                <button name="delete" class="text-danger" type="submit"><i class="fas fa-trash fa-lg"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <?php $sub_total = $value['Price'] * $value['Quantity'];
                                $total += $sub_total;
                                ?>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
            <div class="col-lg-4 col-xl-3 align-middle mb-0 bg-white p-4">
                <?php if (empty($cart_data)) : ?>
                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                        <p class="mb-2">Subtotal</p>
                        <p class="mb-2">$0</p>
                    </div>

                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                        <p class="mb-0">Shipping</p>
                        <p class="mb-0">$0</p>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                        <p class="mb-2">Total (tax included)</p>
                        <p class="mb-2">$0</p>
                    </div>
                <?php else : ?>
                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                        <p class="mb-2">Subtotal</p>
                        <p class="mb-2">$<?= number_format($total, 0, ',', '.') ?></p>
                    </div>

                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                        <p class="mb-0">Shipping</p>
                        <p class="mb-0">$ 30.000</p>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                        <p class="mb-2">Total (tax included)</p>
                        <p class="mb-2">$<?= number_format($total + 30000, 0, ',', '.') ?></p>
                    </div>

                    <a type="button" class="btn btn-primary btn-block btn-lg w-100" href="checkout.php">
                        Checkout
                        <stromg>$<?= number_format($total + 30000, 0, ',', '.') ?></stromg>
                    </a>
                <?php endif; ?>

            </div>

        </div>



    </div>


    <?php include_once 'ic/footer.php' ?>