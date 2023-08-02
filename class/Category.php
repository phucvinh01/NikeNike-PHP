<?php 
    class Category {
        public $id ;
        public $name ;

       public static function getAllCategory()
        {
           include_once '../class/Connection.php';
         
           $db = new Connection();
           $pdo = $db->getConnect();
           $sql = "SELECT * FROM category";
           $stmt = $pdo->prepare($sql);
           $stmt->execute();
           $res = $stmt->fetchAll(PDO::FETCH_ASSOC);       
           return $res;         
        }

        public function insertOneCategory($name) {
            include_once '../class/Connection.php';
          
           $db = new Connection();
           $sql = "INSERT INTO `category`(`Name`) VALUES (?)";
           $pdo = $db->getConnect();
           $stmt = $pdo->prepare($sql);
           if($stmt->execute([$name])) {
                return true;
           }
           else {
                return false ;
           }
        }

        public function checkNameCategory($name) {
            include_once '../class/Connection.php';          
            $db = new Connection();
            $sql = "SELECT * FROM `category` WHERE Name = ?";
            $pdo = $db->getConnect();
            $stmt = $pdo->prepare($sql);
           $stmt->execute([$name]);
           $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0){
                return true ;
            }else {
                return false ;
            }
                         
        }

        public function findById($id) {
            include_once 'Connection.php';          
            $db = new Connection();
            $sql = "SELECT Name FROM `category` WHERE Id = ?";
            $pdo = $db->getConnect();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);            
            $res = $stmt->fetch();
            return $res;
        }

    }