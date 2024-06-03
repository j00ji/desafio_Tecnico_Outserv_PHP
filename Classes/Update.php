<?php
class Update extends Database {
    private $tablename;
    private $id;
    private $column1;
    private $column2;
    private $column3;
    private $column4;

    public function __construct($column1, $column2, $column3 = null, $column4 = null, $tablename, $id)
    {
        $this->tablename = $tablename;
        $this->id = $id;
        $this->column1 = $column1;
        $this->column2 = $column2;
        $this->column3 = $column3;
        $this->column4 = $column4;
    }

    public function updateDB()
    {
        try {
            $conn = $this->connect();
            switch ($this->tablename) {
                case "user":
                    $query = "UPDATE " . $this->tablename . " SET user=?, email=?, password=? WHERE id=?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$this->column1, $this->column2, $this->column3, $this->id]);
                    break;
                case "profile":
                case "permission":
                    $query = "UPDATE " . $this->tablename . " SET nome=?, description=? WHERE id=?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$this->column1, $this->column2, $this->id]);
                    break;
                case "profile_permission":
                    /*
                    $query = "UPDATE " . $this->tablename . " SET IDprofile=?, IDpermission=? WHERE id=?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$this->column1, $this->column2, $this->id]);
                    */
                    echo "Can't edit profile_permissions database.";
                    break;
                default:
                    echo "Couldn't find Database";
                    exit;
            }
            echo "Record updated successfully";
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                echo "Some of that info is already taken.";
            }
            echo "<br>" . $e->getMessage();
        }
    }
}
?>
