<?php
    class Create extends Database {
        private $table;
        private $name;
        private $desc;

        public function __construct($table,$name,$desc)
        {
            $this->table = filter_var($table, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->desc = filter_var($desc, FILTER_SANITIZE_SPECIAL_CHARS);

        }

        public function insertDB(){
            try {
                if($this->table == 'profile_permission'){
                    $column1 = 'IDprofile';
                    $column2 = 'IDpermission';
                } else {
                    $column1 = 'nome';
                    $column2 = 'description';
                }
                $query = "INSERT INTO ". $this->table. "(`". $column1 ."`, `". $column2 ."`)
                VALUES (:nome, :description);";
    
                $stmt = parent::connect()->prepare($query);
                $stmt->bindParam(":nome", $this->name);
                $stmt->bindParam(":description", $this->desc);
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