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
    <title>Document</title>
</head>
<body>
    
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        Username: <br>
        <input type="text" name="username"> <br>
        Password: <br>
        <input type="password" name="pwd"> <br>
        <input type="submit" name="login" value="enviar">
    </form>
    <?php
        if(isset($_POST["login"])){
            require_once "Classes/Validation.php";
            $LoginValidation = new Validation($_POST["username"],$_POST["pwd"]);
            
            if($LoginValidation->ValidateLogin()==true){
                include_once("classes/database.php");
                include_once("classes/Login.php");
                $login = new Login($_POST["username"],$_POST["pwd"]);
            }
        }
    ?>

</body>
</html>

<?php
    include("Include/footer.html");
?>
