<style>
  a {
    font-size: 14px;
    font-weight: 700
  }

  .superNav {
    font-size: 13px;
  }

  .form-control {
    outline: none !important;
    box-shadow: none !important;
  }

  @media screen and (max-width:540px) {
    .centerOnMobile {
      text-align: center
    }
  }

  .cart {
    position: relative;
  }

  .cart-count {
    position: absolute;
    top: 0;
    font-size: 18px;
    right: 10%;
    font-weight: 800;
  }
</style>
<div class="container-fluid text-center" style="background-color: #F4C3C2;">
  <img src="https://i.pinimg.com/564x/28/1c/7a/281c7ab1a58fe4ac4b972a54be5221b6.jpg" alt="" style="width: 20px; height: 20px; background: transparent;">
  <em>Vinh - Hand - Some</em>
  <em>2001200636</em>
</div>
<nav class="navbar navbar-expand-lg bg-white sticky-top navbar-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="https://i.pinimg.com/564x/2a/0f/fa/2a0ffa934ad1d452e6f547ef0f8443df.jpg" style="width: 35px; height: 35px;" alt="" class="rounded-pill">
    </a>
    <div class="mx-auto my-3 d-lg-none d-sm-block d-xs-block">
      <div class="input-group">
        <input type="text" class="form-control border-dark rounded-pill" style="color:#7a7a7a">
        <button class="btn btn-outline-dark text-dark rounded-circle" id="button-addon"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class=" collapse navbar-collapse" id="navbarNavDropdown">

      <ul class="navbar-nav ms-auto ">
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase text-dark" aria-current="page" href="product.php">New & Featured</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase text-dark" href="product.php?cate=Men">Men</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase text-dark" href="product.php?cate=Women">Wonmen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase text-dark" href="product.php?cate=Kids">Kids</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase text-dark" href="#">Sale</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto ">
        <li class="nav-item dropdown">
          <button data-bs-toggle="dropdown" class="btn btn-outline-dark text-dark rounded-circle" id="button-addon"><i class="fa-solid fa-magnifying-glass"></i></button>
          <ul class="dropdown-menu">
            <form action="product-search.php" method="post">
              <div class="input-group">
                <input name="search" type="search" class="form-control border-dark rounded-pill " style="color:#7a7a7a">
                <input type="submit" name="submit" class="btn btn-outline-dark text-dark rounded-circle" value="Search" />
              </div>
            </form>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase cart" href="cart.php"> <i class="fa-solid fa-cart-shopping me-1 fs-3" style="color: #bcecf0;"></i>
            <?php if (isset($_SESSION['count_cart'])) : ?>
              <span class="badge bg-dark rounded-pill cart_count" id="cart_count"><?= $_SESSION['count_cart'] ?></span>
            <?php endif; ?>
          </a>

        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-uppercase" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-regular fa-circle-user fs-3 me-1"></i>
          </a>
          <ul class="dropdown-menu">
            <?php if (isset($_SESSION['user_data'])) : ?>
              <li><a class="dropdown-item" href="user_profile.php">My Profile</a></li>
              <hr>
              <li><a class="dropdown-item" href="logout.php">Log out</a></li>
            <?php else : ?>
              <li><a class="dropdown-item" href="login.php">Log in</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="register.php">Register</a></li>
            <?php endif ?>

          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>