<?php
ini_set ('display_errors', 1); 
ini_set ('display_startup_errors', 1); 
error_reporting (E_ALL);        

session_start();

if(array_key_exists('loginstatus', $_SESSION) && $_SESSION['loginstatus']['status'] == FALSE){
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
    <title>loginpage</title>
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
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>