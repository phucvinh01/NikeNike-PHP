<?php 
    class Connection {    
        public function getConnect() {
        $host = 'localhost';
        $db = 'mydb';
        $user = 'vinhhandsome';
        $pass = 'oY(Q1yvkRCD91!ku';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
            $pdo = new PDO($dsn, $user, $pass);
        
            return $pdo;

        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
         