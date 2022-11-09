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
    <title>add new user</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
    <form method="POST" action="../../process/system.php">
        <input type="name" name="name" placeholder="name">
        <input type="password" name="password" placeholder="password">
        <button type="submit" name="add_new_user">add user</button>
        <form method="POST" action="../../process/system.php">
            <button type="submit" name="go_back">Ga terug</button>
    </form>
    </form>
</body>
</html>