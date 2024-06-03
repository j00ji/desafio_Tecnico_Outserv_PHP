<?php
session_start();
include("Include/header.php");
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
    <title>Update</title>
</head>

<body><?php
    if (isset($_SESSION['username']) && isset($_SESSION['perms'])) :
        if ($_SESSION['perms'] == '1') : //Admin Permission
    ?>
    <?php
    if (isset($_GET["id"]) && isset($_GET["table"])) {
        include("Include/form.php");
    }
    if (isset($_POST["create"])) {

        //echo "ItS ALL WORKING";
        include_once("classes/Database.php");
        include_once("classes/Update.php");
        switch ($_GET["table"]) {
            case 'user':
                require_once "Classes/Validation.php";
                $UpdateValidation = new Validation($_POST["username"], $_POST["pwd"], $_POST["pwdc"], $_POST["email"]);
                if ($UpdateValidation->ValidateSignup() == true) {
                    $update = new Update($_POST["username"], $_POST["email"], $_POST["pwd"], $_POST["profile"], $_GET["table"], $_GET["id"]);
                    $update->updateDB();
                } else {
                    echo "Invalid signup.";
                }
                break;
            case 'profile_permission':
                $update = new Update($_POST["profile"], $_POST["permission"], null, null, $_GET["table"], $_GET["id"]);
                $update->updateDB();
                break;
            case 'profile' or 'permission':
                $update = new Update($_POST["nome"], $_POST["desc"], null, null, $_GET["table"], $_GET["id"]);
                $update->updateDB();
                break;
        }
    }
    ?>
    <?php
        else :
            echo "You don't have permission to access this page.";
        endif;
    else :
        echo "You must be logged to access this page.";
    endif;
    ?>
</body>

</html>
<?php
include("Include/footer.html");
?>