<?php
session_start();
include("Include/header.php");
require_once "Classes/Database.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Read</title>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View</h1>
                    <?php
                    if (isset($_GET["id"]) && isset($_GET["table"]) && is_numeric($_GET["id"]) && !empty(trim($_GET["table"]))) {
                        try {
                            $db = new Database;
                            $row = $db->getInformation($_GET["id"], $_GET["table"]);

                            switch ($_GET["table"]) {
                                case "user":
                                    $column1 = "user";
                                    $column2 = "email";
                                    $column3 = "idProfile";
                                    $column3name = null;
                                    break;
                                case "profile":
                                    $column1 = "nome";
                                    $column2 = "description";
                                    break;
                                case "permission":
                                    $column1 = "nome";
                                    $column2 = "description";
                                    break;
                                case "profile_permission":
                                    $column1 = "IDprofile";
                                    $column2 = "IDpermission";
                                    break;
                                default:
                                    echo "That table doesn't exist";
                                    exit(); // Exit script if table doesn't exist
                            }

                            if ($_GET["table"] === "user" && isset($row['idProfile'])) {
                                $profileName = $db->getInformation($row[$column3], "profile");
                                $column3name = $profileName["nome"];
                            }

                            // Display retrieved information
                            if (isset($column1) && isset($row[$column1])) {
                                if ($_GET["table"] != "profile_permission") {
                                    echo '<div class="form-group">';
                                    echo '<label>' . ucfirst($column1) . '</label>';
                                    echo '<p><b>' . $row[$column1] . '</b></p>';
                                    echo '</div>';
                                } else {
                                    echo '<div class="form-group">';
                                    echo '<label>Profile</label>';
                                    echo '<p><b>' . ucfirst($db->getInformation($row[$column1],"profile")["nome"]) . '</b></p>';
                                    echo '</div>';
                                }
                            }

                            if (isset($column2) && isset($row[$column2])) {
                                if ($_GET["table"] != "profile_permission") {
                                echo '<div class="form-group">';
                                echo '<label>' . ucfirst($column2) . '</label>';
                                echo '<p><b>' . $row[$column2] . '</b></p>';
                                echo '</div>';
                                }
                                else {
                                    echo '<div class="form-group">';
                                    echo '<label>Permission</label>';
                                    echo '<p><b>' . ucfirst($db->getInformation($row[$column2],"permission")["nome"]) . '</b></p>';
                                    echo '</div>';
                                }
                            }

                            if (isset($column3) && isset($row[$column3])) {
                                echo '<div class="form-group">';
                                echo '<label>' . ucfirst($column3name) . '</label>';
                                echo '<p><b>' . $row[$column3] . '</b></p>';
                                echo '</div>';
                            }
                        } catch (PDOException $e) {
                            echo "There's something wrong here";
                            echo "<br>" . $e->getMessage();
                        }
                    } else {
                        echo "Either the user or the table don't exist";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php
    include("Include/footer.html");
?>