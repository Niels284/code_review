<?php
ini_set ('display_errors', 1); 
ini_set ('display_startup_errors', 1); 
error_reporting (E_ALL);   

session_start();

require_once('../../process/classes/process.php');

if(!array_key_exists('loginstatus', $_SESSION) || $_SESSION['loginstatus']['status'] == FALSE){
    header('location:../login/index.php');
} else {
    if(array_key_exists('message', $_SESSION['loginstatus'])) {
        echo '<script>alert("' . $_SESSION['loginstatus']['message'] . '");</script>';
        unset($_SESSION['loginstatus']['message']);
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gebruikerssysteem</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        .add_user {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
    <?php
    $m = new Database;
    if($m->read() == true) {
        echo '<table>';
        echo "<tr><th>user</th><th>iduser</th><th>username</th><th>change password</th><th>delete user</th></tr>"; 
        $i = 1;
        foreach($_SESSION['users'] as $user) {
            $updatePasswordForm = '
            <form method="POST" action="../../process/system.php">
            <input type="hidden" name="iduser" value="' . $user['iduser'] . '">
            <input type="hidden" name="name" value="' . $user['username'] . '">
            <input type="password" name="old_password" placeholder="old password">
            <input type="password" name="new_password" placeholder="new password">
            <button type="submit" name="update_password">update</button>
            </form>
            ';

            $deleteUser = '
            <form method="POST" action="../../process/system.php">
            <input type="hidden" name="iduser" value="' . $user['iduser'] . '">
            <input type="hidden" name="name" value="' . $user['username'] . '">
            <button type="submit" name="delete_user">delete user</button>
            </form>
            ';
            echo "<tr><td>" . $i . "</td><td>" . $user['iduser'] . "</td><td>" . $user['username'] . "</td><td>" . $updatePasswordForm . "</td><td>" . $deleteUser ."</td></tr>"; 
            $i++;
        }       
        echo '</table>';
        unset($_SESSION['users']);
    } else {
        echo $_SESSION['loginstatus']['message'] = "No data avaliable.";
    }
    ?>
    <form method="POST" action="../../process/system.php">
            <button class="add_user" type="submit" name="add_user">+</button>
    </form>
    <br>
    <form method="POST" action="../../process/system.php">
            <button type="submit" name="log_out">log out</button>
    </form>
</body>
</html>