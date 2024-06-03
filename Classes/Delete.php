<?php
    class Delete extends Database{
        private $id;
        private $table;

        public function __construct($id,$table)
        {
            $this->id = $id;
            $this->table = $table;

            $this->deleteDB();
        }

        private function deleteDB(){
            try {
            $query = "DELETE FROM " . $this->table . " WHERE `id` = " . $this->id;
            
            $stmt = parent::connect()->prepare($query);
            $stmt->execute();
            }
            catch(PDOException $e)
            {
                echo "<br>".$e->getMessage();
            }
        }
    }