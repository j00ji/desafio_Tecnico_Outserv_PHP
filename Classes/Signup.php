<?php
    class Signup extends Database{
        private $username;
        private $email;
        private $pwd;
        private $profile;

        public function __construct($username,$email,$pwd,$profile)
        {
            $this->username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $this->pwd = password_hash(filter_var($pwd,FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);
            $this->profile = $profile;
            $this->insertDB();
        }

        private function insertDB(){
            try {
            $query = "INSERT INTO user (`user`, `password`, `email`,`idProfile`) 
            VALUES (:username, :pwd, :email, :profileid);";

            $stmt = parent::connect()->prepare($query);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":pwd", $this->pwd);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":profileid", $this->profile);
            $stmt->execute();
            }
            catch(PDOException $e)
            {
                if($e->errorInfo[1] === 1062){
                    echo "Some of that info is already taken.";
                }
                echo "<br>".$e->getMessage();
            }
        }
    }
