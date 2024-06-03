<?php
    class Login extends Database{
        private $username;
        private $pwd;

        public function __construct($username,$pwd)
        {
            $this->username = $username;
            $this->pwd = $pwd;

            $this->LoginAttempt();
        }

        private function LoginAttempt(){
            try{
                $query  = "SELECT * FROM user WHERE user = :username";

                $stmt = parent::connect()->prepare($query);
                $stmt->bindParam(":username", $this->username);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($this->pwd, $user['password'])){
                    echo "Login Successful";
                    $_SESSION['username'] = $this->username;
                    $_SESSION['perms'] = $user['idProfile'];
                    header("location: index.php");
                }
                else {
                    echo "Passwords don't match bro.";
                }
            }
            catch(PDOException $e)
            {
                if($e->errorInfo[1] === 1062){
                    echo "Some of that info is already taken.";
                }
                else {
                echo "<br>".$e->getMessage();
                }
            }
        }
    }
?>