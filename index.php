<?php
session_start();
include("Include/header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <?php
        if(isset($_SESSION['username']) && isset($_SESSION['perms'])):
            if($_SESSION['perms'] == '1' ) : //Admin Permission
        ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" > 
                    <input type="submit" name="user" value="View Users">
                    <input type="submit" name="profile" value="View Profiles">
                    <input type="submit" name="perms" value="View Permissions">
                    <input type="submit" name="profileperm" value="View Profile Permissions">
                </form>
                    <?php 
                    require_once("Classes/Database.php");
                    include("Classes/Table.php");
                    if(isset($_POST["user"])) {
                        $table = new Table('user','id','user','email','idProfile');
                    } elseif(isset($_POST["profile"])) {
                        $table = new Table('profile','id','nome','description');
                    } elseif(isset($_POST["perms"])) {
                        $table = new Table('permission','id','nome','description');
                    } elseif(isset($_POST["profileperm"])) {
                        $table = new Table('profile_permission','IDprofile','IDpermission');
                    }
                    if(isset($table)){
                    $table->ShowTable();
                    }
                    else {
                        echo "<h3> Choose a table </h3>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        else: 
            echo "You don't have permission to access this page.";
        endif;
    else:
        echo "You must be logged to access this page.";
    endif;
        ?>
        
</body>

</html>

<?php
include("Include/footer.html");
?>