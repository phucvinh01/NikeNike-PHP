<?php session_start();
include 'class/Product.php';
include 'class/Category.php';
$pro = new Product();
$cateId = new Category();
$id = $_GET['id'];
$data = $pro->getOneProductByID($id);
$pro_list = $pro->getRandTeenProducts();

 

include 'class/Cart.php';
$cart = new Cart();


if (isset($_GET['action']) && isset($_GET['id'])) {
  //$pro = new Product();
  $action = $_GET['action'];
  $id = $_GET['id'];
  $pro->getOneProductByID($id);
  if ($action == 'addcart') {
    if (array_key_exists($id, $_SESSION['cart'])) {
      $_SESSION['cart'][$id] += 1;
      if ($cart->update($_SESSION['user_data']['Id'], $_SESSION['cart'][$id], $id) == true) {
        echo 'update';
      }
     
    }
    $cart->add($_SESSION['user_data']['Id'],  $id, 1);
    header('location: cart.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'ic/libary.php' ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

  <title><?= $data[0]['Name'] ?></title>
</head>

<body>
  <?php include 'ic/header.php' ?>

  <div class="container">
    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4 d-flex">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="index.php" class="text-dark">Home</a></li>
        <li class="breadcrumb-item p-0"><a href="product.php" class="text-dark">Product</a></li>
        <li class="breadcrumb-item active"> <?= $data[0]['Name'] ?></li>
      </ol>
    </nav>
    <div class="row">
      <div class="col-sm-7 col-md-7 p-4 me-0">
        <img src="uploads/<?= $data[0]['Image'] ?>" alt="" class="w-100">
      </div>
      <div class="col-sm-5 col-md-5 p-5 me-0 bg-white">
        <h2><?= $data[0]['Name'] ?></h2>
        <?php
        $cateName = $cateId->findById($data[0]['Category']);
        ?>
        <h3 class="card-text text-muted"><?= $cateName[0]  ?></h3>
        <p class="fs-5"> $ <?= number_format($data[0]['Price'], 0, ',', '.') ?></p>
        <strong class="fs-4">
          <?= $data[0]['Description'] ?>
        </strong>
        <br>
        <div class="container">
          <?php if (isset($_SESSION['user_data'])) : ?>
            <a name="" id="" class="btn btn-add-cart btn-dark w-100" href="product-detail.php?action=addcart&id=<?= $data[0]['Id'] ?>" role="button">Add To Cart</a>
            <a name="" id="" class="btn btn-like btn-outline-dark w-100" href="#" role="button">Favourite</a>
          <?php else : ?>
            <a name="" id="" class="btn btn-add-cart btn-dark w-100" href="login.php" role="button">Sign In To Buy</a>
          <?php endif; ?>

        </div>

      </div>
    </div>
    <div class="container mt-5">
      <h2 class="text-dark">You Might Also Like</h2>
      <div class="carousel">
        <?php foreach ($pro_list as $key => $values) : ?>
          <a class="card" href="product-detail.php?id=<?= $values['Id'] ?>" style="text-decoration: none;">
            <div class="img-wrapper">
              <img src="uploads/<?= $values['Image'] ?>" alt="<?php $values['Name'] ?>">

            </div>
            <div class="card-body">
              <h5 class="card-title"><?= $values['Name'] ?></h5>
              <p class="card-text">$<?= $values['Price'] ?></p>
              <?php
              $cateName = $cateId->findById($values['Category']);
              ?>
              <p class="card-text text-muted"><?= $cateName[0] ?></p>
            </div>
          </a>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="app.js"></script>
  <?php include 'ic/footer.php'  ?>