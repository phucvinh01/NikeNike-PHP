<?php
include_once 'Connection.php';

class Cart
{
    public function get($id)
    {
        $db = new Connection();
        $pdo = $db->getConnect();
        $query = "SELECT product.Id ,product.Name , product.Price, product.Image , product.Category , cart.Quantity, cart.Id as Id_cart
                    FROM `cart` , product , user 
                    WHERE product.id = cart.Id_product and user.Id = $id 
                    GROUP BY product.Id , cart.Quantity, cart.Id;";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }


    public function add($id_user, $pro_id, $quantity)
    {
        $db = new Connection();
        $pdo = $db->getConnect();
        $query = "INSERT INTO `cart`(Id_user,Id_product,Quantity) 
            VALUES (?,?,?)";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$id_user, $pro_id, $quantity])) {
            return true;
        } else {
            return false;
        }
    }


    public function update($id_user, $quantity, $id_pro)
    {
        $sql = "UPDATE `cart`
         SET Quantity= $quantity 
         WHERE Id_user = $id_user AND Id_product = $id_pro";
        $db = new Connection();
        $pdo = $db->getConnect();
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id_user, $id_pro)
    {
        $sql = "DELETE FROM `cart`
                WHERE Id_user = $id_user AND Id_product = $id_pro";
        $db = new Connection();
        $pdo = $db->getConnect();
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteAll($id_user)
    {
        $sql = "DELETE FROM `cart`
        WHERE Id_user = $id_user";
        $db = new Connection();
        $pdo = $db->getConnect();
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
