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
    <title>Cadastro</title>
</head>

<body>
    <?php
    if (isset($_SESSION['username']) && isset($_SESSION['perms'])) :
        if ($_SESSION['perms'] == '1') : //Admin Permission
    ?>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <?php
                if (isset($_GET["table"])) {
                    switch ($_GET["table"]) {
                        case "user":
                            echo 'Username: <br>
                 <input type="text" name="username"> <br>
                 Email: <br>
                 <input type="email" name="email"><br>
                 Password: <br>
                 <input type="password" name="pwd"> <br>
                 Confirm Password: <br>
                 <input type="password" name="pwdc"> <br>
                 <div>
                     <label for="profile">Select Profile:</label>
                     <select name="profile" id="profile">';
                            require_once "Classes/Database.php";
                            $db = new Database();
                            $profiles = $db->getProfiles();
                            foreach ($profiles as $profile) {
                                echo "<option value='" . $profile['id'] . "'>" . $profile['nome'] . "</option>";
                            }
                            echo '</select>
                 </div>';
                            break;
                        case "profile":
                            echo 'Profile Name: <br>
                    <input type="text" name="nome"> <br>
                    Description: <br>
                    <input type="text" name="description"><br><div>';
                            break;
                        case "permission":
                            echo 'Permission Name: <br>
                    <input type="text" name="nome"> <br>
                    Description: <br>
                    <input type="text" name="description"><br><div>';
                            break;
                        case "profile_permission":
                            echo '<div>
                    <label for="profile">Select Profile:</label>
                    <select name="profile" id="profile">';
                            require_once "Classes/Database.php";
                            $db = new Database();
                            $profiles = $db->getProfiles();
                            foreach ($profiles as $profile) {
                                echo "<option value='" . $profile['id'] . "'>" . $profile['nome'] . "</option>";
                            }
                            echo '</select>
                </div>
                <div>
                    <label for="profile">Select Permission:</label>
                    <select name="permission" id="permission">';
                            require_once "Classes/Database.php";
                            $db = new Database();
                            $permissions = $db->getPermissions();
                            foreach ($permissions as $permission) {
                                echo "<option value='" . $permission['id'] . "'>" . $permission['nome'] . "</option>";
                            }
                            echo '</select>
                </div>';
                            break;
                        default:
                            echo "<h4>Invalid Database</h4>";
                    }
                }
                ?>


                <input type="submit" name="create" value="enviar">
            </form>
            <?php
            if (isset($_POST["create"])) {
                require_once "Classes/Validation.php";
                if ($_GET['table'] == 'user') {
                    $SignupValidation = new Validation($_POST["username"], $_POST["pwd"], $_POST["pwdc"], $_POST["email"]);

                    if ($SignupValidation->ValidateSignup() == true) {
                        include_once("classes/database.php");
                        include_once("classes/signup.php");
                        $signup = new Signup($_POST["username"], $_POST["email"], $_POST["pwd"], $_POST["profile"]);
                    }
                } elseif ($_GET['table'] == 'profile' or $_GET['table'] == 'permission') {
                    $ProfileValidation = new Validation($_GET['table'], $_POST["nome"], $_POST["description"]);

                    if ($ProfileValidation->ValidateProfile() == true) {
                        include_once("classes/database.php");
                        include_once("classes/create.php");
                        $create = new Create($_GET['table'], $_POST["nome"], $_POST["description"]);
                        $create->insertDB();
                    }
                } elseif ($_GET['table'] == 'profile_permission') {
                    include_once("classes/database.php");
                    include_once("classes/create.php");
                    $create = new Create($_GET['table'], $_POST["profile"], $_POST["permission"]);
                    $create->insertDB();
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