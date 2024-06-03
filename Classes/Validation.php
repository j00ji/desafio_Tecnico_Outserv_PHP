<?php
    class Validation {
        private $username;
        private $email;
        private $pwd;
        private $pwdc;

        public function __construct($username,$pwd,$pwdc=null,$email=null,)
        {
            $this->username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->pwd = $pwd;
            $this->pwdc = $pwdc;
            $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $this->email = filter_var($this->email,FILTER_VALIDATE_EMAIL);
        }

        public function ValidateSignup(){
            if(empty($this->username)){
                echo "Fill in the username";
                return false;
            }
            elseif(empty($this->email)){
                echo "Correctly fill in the email";
                return false;
            }
            elseif(empty($this->pwd)){
                echo "Fill in the password";
                return false;
            }
            elseif(empty($this->pwdc)){
                echo "You have to confirm the password";
                return false;
            }
            elseif($this->pwd!=$this->pwdc){
                echo "Your password is different than the confirmed password";
                return false;
            }
            else{
                return true;
            }
        }

        public function ValidateLogin(){
            if(empty($this->username)){
                echo "Fill in the username";
                return false;
            }
            elseif(empty($this->pwd)){
                echo "Fill in the password";
                return false;
            }
            else{
                return true;
            }
        }

        public function ValidateProfile(){
            $this->pwd = filter_var($this->pwd,FILTER_SANITIZE_SPECIAL_CHARS);
            if(empty($this->username)){
                echo "Fill in the name";
                return false;
            }
            elseif(empty($this->pwd)){
                echo "Fill in the description";
                return false;
            }
            else{
                return true;
            }
        }
    }
?>