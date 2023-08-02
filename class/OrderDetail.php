<?php
include_once 'Connection.php';
class OrderDetail
{
    public function insert($id_order , $id_pro , $price , $quantity)
    {
        $db = new Connection();
        $pdo = $db->getConnect();
        $query = "INSERT INTO `order_detail`(product_id, order_id, price, quantity) 
        VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$id_pro,$id_order, $price , $quantity])) {
            return true;
        } else {
            return false;
        }
    }

    public function getByOrder($id)
    {
        $db = new Connection();
        $pdo = $db->getConnect();
        $stmt = $pdo->prepare("SELECT product.Name , product.Image , product.Price , product.Category , order_detail.quantity 
                            FROM `order_detail` , product
                            WHERE product.Id = order_detail.product_id and order_detail.order_id = $id");
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }
}
