<?php
    class Database {
        private $host = "localhost";
        private $dbname = "outservdb";
        private $dbusername = "root";
        private $dbpassword = "";

        protected function connect(){
            try{
            $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->dbusername, $this->dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
            return $conn;
            }
            catch(PDOException $e) {
                echo "Connection to database failed: " . $e->getMessage();
            }
        }

        public function getProfiles(){
            $query = "SELECT id, nome FROM profile";
            $stmt = $this->connect()->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getPermissions(){
            $query = "SELECT id, nome FROM permission";
            $stmt = $this->connect()->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getInformation($id, $tablename, $selection = '*'){
              $query = "SELECT ". $selection . " FROM ". $tablename ." WHERE id = ". $id;  
            $stmt = $this->connect()->query($query);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }