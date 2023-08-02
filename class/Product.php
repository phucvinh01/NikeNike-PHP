<?php 
    include_once 'Connection.php';
    class Product {
        public $Id;
        public $Name;
        public $Description;
        public $Price;
        public $Image;
        public $Category;

        public function __construct($Id = 0, $Name = '', $Description = '',
         $Price = 0 , $Image = '' , $Category = 0 )
        {
            $this->Id = $Id;
            $this->Name = $Name;
            $this->Description = $Description;
            $this->Price = $Price;
            $this->Image = $Image;
            $this->Category = $Category;
        }

    


        public function getAllProducts()
        {   
            $db = new Connection();
            $pdo = $db->getConnect();  
            $stmt = $pdo->prepare("SELECT * FROM `product` ORDER BY product.Id DESC");
            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);         
            return $list;   
            
                    
        }
        public function getOneProductByID($id)
        {
            $db = new Connection();
            $pdo = $db->getConnect();  
            $stmt = $pdo->prepare("SELECT * FROM product Where Id = $id");
            $stmt->execute();
            $product = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $product ;
        }

        public function insertNewProduct(Product $pro){
            
            $db = new Connection();
            $pdo = $db->getConnect(); 
            $query = "INSERT INTO `product`(Name,Price,Description,Image,Category)
             VALUES (?,?,?,?,?)";
            $stmt = $pdo->prepare($query);
            if($stmt->execute([$pro->Name,$pro->Price,$pro->Description,$pro->Image,$pro->Category])) {
                return true;
            }
            else {
                return false;
            }
                  
        }

        public function deleteProduct($Id) {       
            $db = new Connection();
            $pdo = $db->getConnect(); 
            $query = "DELETE FROM product WHERE Id = :id";
            $stmt = $pdo->prepare($query);        
            $stmt->bindParam(':id' , $Id , PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function editProduct(Product $pro){ 
            $query = "UPDATE product SET Name = :name,Price = :price , Description = :desc, Image = :img, Category = :cate WHERE Id = :id";
            $db = new Connection();
            $pdo = $db->getConnect(); 
            $stmt = $pdo->prepare($query);        
            $stmt->bindParam(':id' , $pro->Id , PDO::PARAM_INT);
            $stmt->bindParam(':name' , $pro->Name , PDO::PARAM_STR);
            $stmt->bindParam(':price' , $pro->Price , PDO::PARAM_INT);
            $stmt->bindParam(':desc' , $pro->Description , PDO::PARAM_STR);
            $stmt->bindParam(':img' , $pro->Image , PDO::PARAM_STR);
            $stmt->bindParam(':cate' , $pro->Category , PDO::PARAM_STR);
            if($stmt->execute()){
                return true ;
            }
            else {
                return false;
            }
        }

        

        public function getRandTeenProducts()
        {   
            $db = new Connection();
            $pdo = $db->getConnect();  
            $stmt = $pdo->prepare("SELECT * FROM product ORDER BY RAND() LIMIT 10");
            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);         
            return $list;   
            
                    
        }

        public function searchProducts($data){
            $db = new Connection();
            $pdo = $db->getConnect();  
            $stmt = $pdo->prepare("SELECT * FROM product WHERE Name LIKE '% $data %'");
          
            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);         
            return $list;
        }

        public function productForMen($data) {
            $db = new Connection();
            $pdo = $db->getConnect();  
            $stmt = $pdo->prepare("SELECT product.Id , product.Name , product.Price , product.Description, product.Image, product.Category FROM product , category WHERE product.Category = Category.Id AND category.Name = '$data' ORDER BY product.Id DESC");
            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);         
            return $list;
        }

        public function productSortLowHight() {
            $db = new Connection();
            $pdo = $db->getConnect();  
            $stmt = $pdo->prepare("SELECT * FROM product ORDER BY product.Price");
            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);         
            return $list;
        }

        public function productSortHightLow() {
            $db = new Connection();
            $pdo = $db->getConnect();  
            $stmt = $pdo->prepare("SELECT * FROM product ORDER BY product.Price DESC");
            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);         
            return $list;
        }
}