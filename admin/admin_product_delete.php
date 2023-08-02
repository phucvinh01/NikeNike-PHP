<?php 
    require '../class/Product.php';
    $id = $_GET['id'];
    $pro = new Product();
    
    if($pro->deleteProduct($id))
    {
        header('location: admin_product.php');
    }