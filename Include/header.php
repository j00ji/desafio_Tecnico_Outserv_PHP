<h1>Desafio Técnico</h1>
<a href="index.php">Home</a>
<?php
    if(isset($_SESSION['username'])){
        echo "<a href='Logout.php'>Logout</a>";
    }
    else {
        echo "<a href='Login.php'>Login</a>";
    }
    ?>
<a href="Signup.php">SignUp</a>
<hr>
