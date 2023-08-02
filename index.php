<?php session_start();
include 'class/Product.php';
include 'class/Category.php';
$pro = new Product();
$pro_list = $pro->getRandTeenProducts();
$cateId = new Category();
if(isset($_SESSION['admin_email'])){
  header('location: admin/admin_dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'ic/libary.php' ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <title>Nike - Nike</title>
</head> 

<body>
  <?php include 'ic/header.php' ?>
  <div class="container-fluid bg-body-tertiary">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="1500">
          <p class="text-center pt-3">FREE SHIP VỚI HÓA ĐƠN TỪ 800K</p>
        </div>
        <div class="carousel-item" data-bs-interval="1500">
          <p class="text-center pt-3">BUY MORE PAY LESS - Áp Dụng Khi Mua Phụ Kiện </p>
        </div>
        <div class="carousel-item" data-bs-interval="1500">
          <p class="text-center pt-3">HÀNG 2 TUẦN NHẬN ĐỔI - GIÀY BẢO HÀNH NỮA NĂM</p>
        </div>
        <div class="carousel-item" data-bs-interval="1500">
          <p class="text-center pt-3">BUY 2 GET 10% OFF - Áp Dụng Với Tất Cả Basic Tee</p>
        </div>
      </div>
    </div>
  </div>
  <!--sesstion product -->
  <section class="container container-main">
    <h2 class="main-text">Day One!</h3>
      <p class="main-sub">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis veritatis officiis, perspiciatis ea quas itaque molestias iusto quidem aperiam dolores ut hic, eveniet eligendi amet vitae, fugit consequatur explicabo aliquam?</p>
      <a href="product.php" class="btn btn-outline-light p-3 btn-main-1">
        <span class="main-btn-text">SHOPPING NOW </span>
        <span class="main-btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
      </a>
  </section>
  <div class="container mt-5">
    <h2 class="text-dark">Product list</h2>
    <div class="carousel">
      <?php foreach ($pro_list as $key => $values) : ?>
        <a class="card" href="product-detail.php?id=<?= $values['Id']?>" style="text-decoration: none;">
          <div class="img-wrapper">
            <img src="uploads/<?= $values['Image'] ?>" alt="<?php  $values['Name'] ?>">

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

  <section class="mt-5 container">
    <h2>Category</h2>
    <div class="row category">
      <div class="col-md-4 col-sm-4 col-lg-4 category-col">
        <div class="card position-relative">
          <img class="img-rounded" src="https://i.pinimg.com/736x/55/8a/f3/558af302a9c9583b42411bc8ae9e1f5b.jpg" alt="">

          <a href="product.php?cate=Men" class="btn btn-outline-dark btn-cate">Man</a>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-lg-4 category-col">
        <div class="card position-relative">
          <img class="img-rounded" src="https://i.pinimg.com/736x/9e/f9/1c/9ef91c7739d577d0d91fb94735195878.jpg" alt="">


          <a href="product.php?cate=Women" class="btn btn-outline-dark btn-cate">Woman</a>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-lg-4 category-col">
        <div class="card position-relative">
          <img class="img-rounded" src="https://i.pinimg.com/750x/c0/35/c6/c035c6d6f6fdfceaa8ec90917658f6a4.jpg" alt="">
          <a href="product.php?cate=Kids" class="btn btn-outline-dark btn-cate">Kids</a>
        </div>
      </div>
    </div>
  </section>


  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="app.js"></script>



  <?php include 'ic/footer.php' ?>