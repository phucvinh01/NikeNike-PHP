<?php
session_start();
include 'class/Cart.php';
include 'class/Category.php';
include 'class/Order.php';
include 'class/OrderDetail.php';
$cart = new Cart();
$order = new Order();
$order_detail = new OrderDetail();
if (isset($_SESSION['user_data'])) {
    $cart_data = $cart->get($_SESSION['user_data']['Id']);
    $_SESSION['count_cart'] = count($cart_data);
}


$cateId = new Category();

if (isset($_POST['submit'])) {
    $id_user = $_SESSION['user_data']['Id'];
    $name =   $_POST['name'];
    $total = $_POST['total'];
    $phone = $_POST['phone'];
    $address = $_POST['sub_address'] . " - " . $_POST['city']
        .  " - " . $_POST['district'] .  " - " . $_POST['ward'];
    $method = $_POST["paymentMethod"];
    date_default_timezone_set("Asia/Bangkok");
    $today = getdate();
    $day =  $today['hours'].":".$today['minutes']. " " . $today['mon'] . "-" . $today['month'] . "-" . $today['year'];

    $orderId = $order->insert($id_user,$name,$phone,$address,$total,$day,$method);

    //echo  $orderId ; 

    if($orderId > 0){
        foreach ($cart_data as $item => $value) {
            $order_detail->insert($orderId,$value['Id'],$value['Price'],$value['Quantity']);
        }
        $cart->deleteAll($id_user);
        header('Location: success.php?id='.$orderId);       
    }
    else {
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
    <?php include 'ic/libary.php' ?>
    <title>ChecK out - Nike Nike</title>
</head>

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>

<body class="bg-light">
    <?php include 'ic/header.php' ?>
    <div class="container">
        <main>
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4 d-flex">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"> <a href="index.php" class="text-dark"> Home </a></li>
                    <li class="breadcrumb-item "> <a href="cart.php" class="text-dark"> Your Bag</a></li>
                    <li class="breadcrumb-item active"> Check out </li>
                </ol>

            </nav>
            <form class="needs-validation" method="POST" action="">
                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Your cart</span>
                            <span class="badge bg-primary rounded-pill"><?= count($cart_data) ?></span>
                        </h4>

                        <ul class="list-group mb-3">
                            <?php
                            $total = 0;
                            $sub_total = 0;
                            foreach ($cart_data as $item => $value) : $list_proID[] = $value['Id'] ?>
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div class="d-flex align-items-center">

                                        <img src="uploads/<?= $value['Image'] ?>" class="img-fluid rounded-3" style="width: 120px;" alt="Book">
                                        <div class="flex-column ms-4">
                                            <p class="mb-2"><?= $value['Name'] ?></p>
                                            <?php
                                            $cateName = $cateId->findById($value['Category']);
                                            ?>
                                            <p class="card-text text-muted"><?= $cateName[0] ?></p>
                                            <p class="card-text text-muted"><?= $value["Quantity"] ?></p>
                                            <p class="card-text text-muted"><?= number_format($value['Price'], 0, ',', '.') ?></p>
                                        </div>
                                    </div>
                                </li>
                            <?php
                                $sub_total = $value["Quantity"] * $value['Price'];
                                $total += $sub_total;
                            endforeach; ?>
                            <input type="hidden" value="<?= $list_proID[0] ?> " name="id_pro">
                            <input type="hidden" name="total" value="<?= $total + 30000 ?> ">
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Shipping</h6>
                                </div>
                                <span class="text-success">$ 30.000</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong><?= number_format($total + 30000, 0, ',', '.') ?></strong>
                            </li>
                        </ul>

                        <form class="card p-2">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Promo code">
                                <button type="submit" class="btn btn-secondary">Redeem</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Billing address</h4>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Valid Name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" value="<?= $_SESSION['user_data']['Email'] ?>">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Phone <span class="text-muted">(Optional)</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="" value="<?= $_SESSION['user_data']['Phone'] ?>">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="sub_address" placeholder="1234 Main St" required value="<?= $_SESSION['user_data']['Address'] ?>">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select" id="city" required name="city">
                                    <option value="" selected>Select a country</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <select id="district" class="form-select" required name="district">
                                    <option value="" selected>Select a state</option>
                                </select>
                                <input class="billing_address_2" name="" type="hidden" value="">

                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="state" class="form-label">Ward</label>
                                <select id="ward" class="form-select" required name="ward">
                                    <option value="" selected>Select a ward</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">

                        <h4 class="mb-3">Payment</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required value="COD">
                                <label class="form-check-label" for="credit">COD</label>
                            </div>
                        </div>

                        <hr class="my-4">

                        <input class="w-100 btn btn-outline-dark btn-lg" type="submit" name="submit" value="Continue to checkout" />
            </form>
    </div>
    </div>
    </div>
    </main>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        const host = "https://provinces.open-api.vn/api/";
        var callAPI = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data, "city");
                });
        }
        callAPI('https://provinces.open-api.vn/api/?depth=1');
        var callApiDistrict = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.districts, "district");
                });
        }
        var callApiWard = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.wards, "ward");
                });
        }

        var renderData = (array, select) => {
            let row = ' <option disable value="">Chọn</option>';
            array.forEach(element => {
                row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row
        }

        $("#city").change(() => {
            callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
            printResult();
        });
        $("#district").change(() => {
            callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
            printResult();
        });
        $("#ward").change(() => {
            printResult();
        })

        var printResult = () => {
            if ($("#district").find(':selected').data('id') != "" && $("#city").find(':selected').data('id') != "" &&
                $("#ward").find(':selected').data('id') != "") {
                let result = $("#city option:selected").text() +
                    " | " + $("#district option:selected").text() + " | " +
                    $("#ward option:selected").text();
                $("#result").text(result)
            }

        }
    </script>
    <?php include 'ic/footer.php' ?>