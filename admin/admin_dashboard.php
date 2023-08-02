<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../ventor/PHPMailer-master/src/Exception.php';
require '../ventor/PHPMailer-master/src/PHPMailer.php';
require '../ventor/PHPMailer-master/src/SMTP.php';
include '../class/Order.php';
include '../class/Category.php';
include '../class/OrderDetail.php';
include '../class/User.php';
$admin_email = $_SESSION['admin_email'];
if (!isset($admin_email)) {
    header('location:admin_login.php');
}
$order = new Order();
$cateId = new Category();
$order_detail = new OrderDetail();
$order_data = $order->getAll();
$user = new User();
$mess = "";

if (isset($_POST["sent_mail"])) {

    $id = $_POST['id_user'] ;

    $res = $user->findEmailById($id);

    $email = $res['Email'];
    $mail = new PHPMailer;
    //$mail->SMTPDebug = 3;                             // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.elasticemail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'nguyenphucvinh1920@gmail.com';                 // SMTP username
    $mail->Password = '85F6B83ADBCBEB83397D94DC3830DD052240';                           // SMTP password
    $mail->Port = 2525;                                    // TCP port to connect to

    $mail->From = 'vn150746@gmail.com';
    $mail->FromName = 'Test phpmailer';
    $mail->addAddress($email);               // Name is optional

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if (!$mail->send()) {
        $mess = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong>' .$mail->ErrorInfo.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        $mess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong>' .' Mail has been sent '.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'ic/libary.php'; ?>
    <title>Admin - Dashboard</title>
</head>

<?php include 'ic/admin_header.php'; ?>

<div class="container">
    <table class="table align-middle mb-0 bg-white text-center">
        <thead class="bg-light">
            <tr>
                <th>Cusomter</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Address</th>
                <th>Time Order</th>
                <th>Total</th>
                <th>Comfrim</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_data as $item => $value) :
                $products = $order_detail->getByOrder($value['Id']);
            ?>
                <tr>

                    <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-3">
                                <p class="fw-bold mb-1"><?= $value['Name'] ?></p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <?php foreach ($products as $item => $product) : ?>
                            <div class="d-flex align-items-center">
                                <img src="../uploads/<?= $product['Image'] ?>" alt="" style="width: 120px; height:120px" class="img-fluid rounded-3" />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1"><?= $product['Name'] ?></p>
                                    <?php
                                    $cateName = $cateId->findById($product['Category']);
                                    ?>
                                    <p class="text-muted mb-0"><?= $cateName[0] ?></p>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    </td>

                    <td>
                        <?php foreach ($products as $item => $product) : ?>
                            <div class="d-flex align-items-center align-middle p-5">
                                <p class="fw-bold mb-1"><?= $product['quantity'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    </td>

                    <td>
                        <p class="fw-bold mb-1"><?= $value['Number'] ?></p>
                        <p class="fw-bold mb-1"><?= $value['Address'] ?></p>
                    </td>
                    <td>
                        <p class="fw-bold mb-1"><?= $value['Day_order'] ?></p>
                    </td>
                    <td>
                        <p class="fw-bold mb-1">$<?= number_format($value['Total_price'], 0, ',', '.') ?></p>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id_user" value="<?= $value['User_Id'] ?>">
                            <button type="submit" class="btn btn-outline-dark btn-sm btn-rounded" name="sent_mail">
                                <i class="fa-solid fa-check" style="color: #8aadea;"></i>
                        </form>
                        </a>
                    </td>                   
                </tr>              
               
            <?php endforeach; ?>
            <span> <?= $mess ?> </span>
        </tbody>
    </table>
</div>

<?php include 'ic/admin_footer.php'; ?>