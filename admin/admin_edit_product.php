<?php session_start();
include '../class/Category.php';
include '../class/Product.php';

$id = $_GET['id'];

$product = new Product();
$product_data = $product->getOneProductByID($id);


$cate = Category::getAllCategory();
$mess = "";
$nameErrors = "";
$priceErrors = "";
$descErrors = "";

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $cate = $_POST['cate_id'];
    $image = $_FILES['image']['name'];

    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $image_ext;
    $pro_ex = new Product();
    $pro = new Product($id, $name, $description, $price, $file_name, $cate);
    if ($pro_ex->editProduct($pro) == true) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $file_name);
        header('location: admin_product.php');
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
    <?php include 'ic/libary.php'; ?>
    <title>Admin - Edit - Product</title>
</head>
<style>
    .size {
        height: 300px;
        width: 300px;
    }

    @media screen and (max-width: 800px) {
        .col-3 {
            display: none;
        }
    }
</style>

<body>
    <?php include_once 'ic/admin_header.php' ?>
    <div class="">
        <div class="container-fluid row">
            <div class="col-2">
                <?php include_once 'ic/admin_sidebar.php' ?>
            </div>
            <?php foreach ($product_data as $item) : ?>
            <div class="col-md-7 col-sm-7 col-lg-7">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item "><a href="admin_product.php">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $item['Name'] ?></li>
                    </ol>
                </nav>
                <form class="row justify-content-center align-items-center g-2 shadow-sm p-3 mb-5 bg-white rounded m-4" method="POST" action="" enctype="multipart/form-data">
                    <div>
                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Edit Product</h3>
                        <div class="form-outline mb-4">
                        <input type="hidden" id="Name" class="form-control form-control-lg" name="id" required value="<?= $item['Id'] ?>"/>
                            <input type="text" id="Name" class="form-control form-control-lg" name="name" required value="<?= $item['Name'] ?>"/>
                            <label class="form-label" for="password">Name</label>
                            <span class="text-danger text-muted"><?= $nameErrors ?></span>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="number" id="Price" class="form-control form-control-lg" name="price" required value="<?= $item['Price'] ?>"/>
                            <label class="form-label" for="password">Price</label>
                            <span class="text-danger text-muted"><?= $priceErrors ?></span>
                        </div>
                        <div class="form-outline mb-4">
                            <div class="form-group">
                                <select name="cate_id" class="form-control form-control-lg" id="exampleFormControlSelect1">
                                    <?php foreach ($cate as $items => $key) : ?>
                                        <option value="<?= $key['Id'] ?>"><?= $key['Name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="exampleFormControlSelect1">Category</label>
                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" id="password" class="form-control form-control-lg" name="description" required value="<?= $item['Description'] ?>"/>
                            <label class="form-label" for="password">Description</label>
                            <span class="text-danger text-muted"><?= $descErrors ?></span>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="file" name="image" class="form-control form-control-lg w-100 mb-3" required value="<?= $item['Image'] ?>">
                        </div>

                        <div class="pt-1 mb-4">
                            <input class="btn btn-info btn-lg btn-block" type="submit" value="Update Now" name="submit">
                        </div>


                    </div>
                </form>
            </div>
            <div class="col-3 mt-4 res">
                <img class="card-img-top w-100 mb-3" src="../uploads/<?= $item['Image'] ?>" alt="Title">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    </div>





    <?php include_once 'ic/admin_footer.php' ?>