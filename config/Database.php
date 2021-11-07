<?php
require 'vendor/autoload.php';

    class Database{
        private static $host = 'localhost';
        private static $port = '27010';
        private static $username = '';
        private static $password = '';
        private static $conn;
        private static $connectedDb;

        public function connect(){
            self::$conn = null;
            try{
                if(self::$username == ''){
                    self::$conn = new MongoDB\Client;
                }else{
                    self::$conn = new MongoDB\Client('mongodb://' . self::$username . ':' . self::$password . '@' . self::$host . ': ' . self::$port . '');
                }
                self::$connectedDb = self::$conn->Obligatorio;
            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }
        }

        public function createCollection($collectionName){
            self::$connectedDb->createCollection($collectionName);
        }
    }
?>