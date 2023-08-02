<?php 
    class User {
        public $Id;
        public $Name ;
        public $Email ;
        public $Password;
        public $Image;
        public $Phone;
        public $Address;

        public function __construct($id = 0 , $name = "" ,
        $email = "" , $pass = "", $phone = "", $address = "" , $image ="")
       {
           $this->Id = $id ;
           $this->Name = $name;
           $this->Email = $email;
           $this->Password = $pass;
           $this->Phone = $phone;
           $this->Address = $address;
           $this->Image = "avatar_defaut.jpg";
       }

        public function checkAdminLogin($email, $passwrod) {
            include_once 'Connection.php';
            $db = new Connection();
            $pdo = $db->getConnect();
            $sql = "SELECT * FROM `user` WHERE Email = ? and Password = ?";
            $stmt = $pdo->prepare($sql);
    
            $stmt->execute([$email , $passwrod]) ;
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() > 0){
                if($res['role'] == 1) {
                    return true ;
                }
                
            }else {
                return false ;
            }
        }

        public function checkEmail($email) {
            include_once 'Connection.php';
            $db = new Connection();
            $pdo = $db->getConnect();
            $sql = "SELECT * FROM `user` WHERE Email = ?";
            $stmt = $pdo->prepare($sql);    
            $stmt->execute([$email]) ;
            $stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() > 0){
                return true ;
            }else {
                return false ;
            }
        }

        public function findUserByEmail($email) { 
            include_once 'Connection.php';
            $db = new Connection();
            $pdo = $db->getConnect();  
            $sql = "SELECT * FROM user WHERE Email = ? ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);       
            return $res;            
        }


        public function UpdateUser(User $user) {
            $sql = "UPDATE user SET Name = ? ,Email = ?,Password = ?, Image = ? ,Phone= ?,Address= ? WHERE Id = ?";
            include_once 'Connection.php';
            $db = new Connection();
            $pdo = $db->getConnect();
            $stmt = $pdo->prepare($sql); 
            if($stmt->execute([$user->Name,$user->Email,$user->Password,$user->Image,$user->Phone,$user->Address,$user->Id])){
                return true;
            }         
            else {
                return false;
            }
            
        }

        public function insertUser(User $user) {
            $sql = "INSERT INTO `user`(`Id`, `Name`, `Email`, `Password`, `Image`, `Phone`, `Address`)
            VALUES (?,?,?,?,?,?,?)";
            include_once 'Connection.php';
            $db = new Connection();
            $pdo = $db->getConnect();
            $stmt = $pdo->prepare($sql);
            if( $stmt->execute([$user->Id,$user->Name, $user->Email, $user->Password,$user->Image,$user->Phone,$user->Address])){
               return true;
            }
            else {
                return false;
            }
        }

        public function checkLogin($email , $password){
            $sql = "SELECT * FROM `user` WHERE Email = ?  and Password = ?";
            include_once 'Connection.php';
            $db = new Connection();
            $pdo = $db->getConnect();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email , $password]) ;
            $stmt->fetch(PDO::FETCH_ASSOC);
            $res = $stmt->fetch(PDO::FETCH_ASSOC); 
            if($stmt->rowCount() > 0){
                return true; 
            }else {
                return false ;
            }
        }

        public function findEmailById($id) {
            include_once 'Connection.php';
            $db = new Connection();
            $pdo = $db->getConnect();  
            $sql = "SELECT * FROM user WHERE Id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);       
            return $res;  
        }


        public function updateToken($email ,$code) {
            include_once 'Connection.php';
            $db = new Connection();
            $pdo = $db->getConnect(); 
            $sql = "UPDATE `user` SET token = $code WHERE Email = '$email' ";
            $stmt = $pdo->prepare($sql);
            if($stmt->execute()){
                return true;
            }
            else {
                return false;
            }
                                
        }

        public function checkCode($email ,$code){
            include_once 'Connection.php';
            $db = new Connection();
            $pdo = $db->getConnect();
            $sql = "SELECT * FROM `user` WHERE Email = '$email' AND token = $code";
            $stmt = $pdo->prepare($sql);    
            $stmt->execute();
            $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0){
                return true ;
            }else {
                return false ;
            }
        }

        public function updatePassword($email , $password){
            include_once 'Connection.php';
            $db = new Connection();
            $pdo = $db->getConnect(); 
            $sql = "UPDATE `user` SET Password = '$password' WHERE Email = '$email' ";
            $stmt = $pdo->prepare($sql);
            if($stmt->execute()){
                return true;
            }
            else {
                return false;
            }
        }
           
        
    }