    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <?php if ($_GET['table'] == 'user') : ?>
            Username: <br>
            <input type="text" name="username"> <br>
            Email: <br>
            <input type="email" name="email"><br>
            Password: <br>
            <input type="password" name="pwd"> <br>
            Confirm Password: <br>
            <input type="password" name="pwdc"> <br>
            <div>
                <label for="profile">Select Profile:</label>
                <select name="profile" id="profile">
                    <?php
                    require_once "Classes/Database.php";
                    $db = new Database();
                    $profiles = $db->getProfiles();
                    foreach ($profiles as $profile) {
                        echo "<option value='" . $profile['id'] . "'>" . $profile['nome'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="submit" name="create" value="enviar">
        <?php elseif ($_GET['table'] == 'profile' or $_GET['table'] == 'permission') : ?>
            Name: <br>
            <input type="text" name="nome"> <br>
            Description: <br>
            <input type="text" name="desc"><br>
            <input type="submit" name="create" value="enviar">
        <?php else: { echo "You can't update this database"; }
        endif?>
        
        
    </form>