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
    <title>Delete</title>
</head>
<body>
    <?php
        if(isset($_GET['id']) && isset($_GET['table'])): 
        require_once('classes/Database.php');
        $db = new database;
    ?>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h3>Are you sure you want to delete <?php  
            switch ($_GET['table']){
                case 'user':
                    echo $db->getInformation($_GET['id'],$_GET['table'])['user'];
                    break;
                case 'profile_permission':
                        echo $_GET['id'];
                        break;
                case 'profile' or 'permission':
                    echo $db->getInformation($_GET['id'],$_GET['table'])['nome'];
                    break;
            }
             ?> from table <?php echo $_GET['table']; ?>?
             <br>
            <input type="submit" name="delete" value="Yes"> 
            <input type="submit" name="keepit" value="No">
             </h3>
    </form>

    <?php
        else : echo "Invalid Table or ID";
        
    endif;
    
    ?>
</body>
</html>

<?php
    if (isset($_POST["delete"])) {
        try{
        require_once("classes/Delete.php");
        $Delete = new delete($_GET['id'],$_GET['table']);
        header("location:index.php");
        }
        catch(PDOException $e){
            echo "<br>".$e->getMessage();
        }
    }
    elseif (isset($_POST["keepit"])) {
        header("location:index.php");
    }

    include("Include/footer.html");
?>
