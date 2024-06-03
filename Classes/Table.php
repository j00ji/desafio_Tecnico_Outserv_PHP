<?php
class Table extends Database
{
    private $table;
    private $column1;
    private $column2;
    private $column3;
    private $column4;
    private $column5;

    public function __construct($table = null, $column1 = null, $column2 = null, $column3 = null, $column4 = null, $column5 = null,)
    {
        $this->table = $table;
        $this->column1 = $column1;
        $this->column2 = $column2;
        $this->column3 = $column3;
        $this->column4 = $column4;
        $this->column5 = $column5;
    }

    public function ShowTable()
    {
        $query  = "SELECT * FROM " . $this->table;
        $stmt = parent::connect()->prepare($query);
        $stmt->execute();
        echo '
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">' . ucfirst($this->table) . ' Details</h2>
                    <a href="create.php?table=' . $this->table . '" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New ' . ucfirst($this->table) . '</a>
                </div>';
        if ($stmt->rowCount() > 0) {
            echo '<table class="table table-bordered table-striped">';
            echo "<thead>";
            echo "<tr>";
            if (isset($this->column1)) {
                if ($this->table != "profile_permission") {
                    echo "<th>" . ucfirst($this->column1) . "</th>";
                } else {
                    echo "<th>Profile</th>";
                }
            }
            if (isset($this->column2)) {
                if ($this->table != "profile_permission") {
                    echo "<th>" . ucfirst($this->column2) . "</th>";
                } else {
                    echo "<th>Permission</th>";
                }
            }
            if (isset($this->column3)) {
                echo "<th>" . ucfirst($this->column3) . "</th>";
            }
            if (isset($this->column4)) {
                echo "<th>" . ucfirst($this->column4) . "</th>";
            }
            if (isset($this->column5)) {
                echo "<th>" . ucfirst($this->column5) . "</th>";
            }
            echo "<th>Actions</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                if (isset($this->column1)) {
                    if ($this->table != "profile_permission") {
                        echo "<td>" . $row[$this->column1] . "</td>";
                    } else {
                        echo "<td>" . parent::getInformation($row[$this->column1], 'profile')['nome'] . "</td>";
                    }
                }
                if (isset($this->column2)) {
                    if ($this->table != "profile_permission") {
                        echo "<td>" . $row[$this->column2] . "</td>";
                    } else {
                        echo "<td>" . parent::getInformation($row[$this->column2], 'permission')['nome'] . "</td>";
                    }
                }
                if (isset($this->column3)) {
                    echo "<td>" . $row[$this->column3] . "</td>";
                }
                if (isset($this->column4)) {
                    echo "<td>" . $row[$this->column4] . "</td>";
                }
                if (isset($this->column5)) {
                    echo "<td>" . $row[$this->column5] . "</td>";
                }
                echo "<td>";
                echo '<a href="read.php?id=' . $row['id'] . '&amp;table=' . $this->table . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                if ($this->table != 'profile_permission') {
                    echo '<a href="update.php?id=' . $row['id'] . '&amp;table=' . $this->table . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                }
                echo '<a href="delete.php?id=' . $row['id'] . '&amp;table=' . $this->table . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            // Free result set
            unset($stmt);
        } else {
            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
        }
    }
}
