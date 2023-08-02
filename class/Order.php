<?php
include_once 'Connection.php';
class Order
{
    public function insert($id_user, $name, $phone, $address, $total, $day, $payment)
    {
        $db = new Connection();
        $pdo = $db->getConnect();
        $query = "INSERT INTO `orders`(User_Id, Name, Number, Address, Total_price, Day_order, Payment_status) 
        VALUES (?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$id_user, $name, $phone, $address, $total, $day, $payment])) {
            return $pdo->lastInsertId();
        } else {
            return false;
        }
    }
    public function getByIdUser($id_user, $id_order)
    {
        $db = new Connection();
        $pdo = $db->getConnect();
        $stmt = $pdo->prepare("SELECT orders.Name  as FullName , orders.Number , orders.Address , orders.Day_order , orders.Payment_status , orders.Total_price , product.Name , product.Image , product.Category , order_detail.quantity 
        FROM order_detail , orders , product , user 
        WHERE orders.Id = order_detail.order_id and orders.Id = $id_order and orders.User_Id = $id_user and order_detail.product_id = product.Id 
        GROUP BY product.Name , product.Image , product.Category , orders.Name , orders.Number , orders.Address , orders.Day_order , orders.Payment_status , orders.Total_price ,order_detail.quantity");
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }


    public function getHistoryOrderByUser($id_user)
    {
        $db = new Connection();
        $pdo = $db->getConnect();
        $stmt = $pdo->prepare("SELECT orders.Id , orders.Day_order , orders.Payment_status , orders.Total_price , product.Name , product.Image , product.Category , order_detail.quantity 
        FROM order_detail , orders , product , user 
        WHERE orders.Id = order_detail.order_id and orders.User_Id = $id_user and order_detail.product_id = product.Id 
        GROUP BY orders.Id , orders.Day_order , orders.Payment_status , orders.Total_price , product.Name , product.Image , product.Category , order_detail.quantity");
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

    public function getAll()
    {
        $db = new Connection();
        $pdo = $db->getConnect();
        $stmt = $pdo->prepare("SELECT * FROM orders");
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }
}
