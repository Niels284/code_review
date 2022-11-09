<?php 
ini_set ('display_errors', 1); 
ini_set ('display_startup_errors', 1); 
error_reporting (E_ALL);        

session_start();

require_once('classes/process.php');

if(!array_key_exists('loginstatus', $_SESSION)) {
    $_SESSION['loginstatus'] = [];
}

// CRUD functies

// CREATE

if(isset($_POST['add_new_user'])){
    if(!empty($_POST['name']) && !empty($_POST['password'])) {
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $password = htmlspecialchars(strip_tags($_POST['password']));
        unset($_POST);

        $m = new Database();
        if($m->add_user($name, $password) == true) {
            $_SESSION['loginstatus']['message'] = "Gebruiker '" . $name . "' is succesvol toegevoegd aan het gebruikerssysteem!";
            header('location:../screens/client/client.php');
        } 
    }      
}

// READ

if(isset($_POST['login'])){
    if(!empty($_POST['name']) && !empty($_POST['password'])) {
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $password = htmlspecialchars(strip_tags($_POST['password']));
        unset($_POST);

        $m = new Database();
        if($m->check($name, $password) == true) {
            $_SESSION['loginstatus']['username'] = $name;
            $_SESSION['loginstatus']['status'] = true;
            $_SESSION['loginstatus']['message'] = "Je bent succesvol ingelogd " . $name . "!";
            header('location:../screens/client/client.php');
        } else {
            $_SESSION['loginstatus']['status'] = false;
            $_SESSION['loginstatus']['message'] = "Gebruikersnaam of wachtwoord zijn incorrect!";
            header('location:../screens/login/index.php');
        }
    } else {
        $_SESSION['loginstatus']['status'] = false;
        $_SESSION['loginstatus']['message'] = "Velden zijn leeg, zet er een waarde in!";
        header('location:../screens/login/index.php');
    }       
} 

// UPDATE

if(isset($_POST['update_password'])){
    if(!empty($_POST['iduser']) && !empty($_POST['name']) && !empty($_POST['old_password']) && !empty($_POST['new_password'])) {
        $iduser = htmlspecialchars(strip_tags($_POST['iduser']));
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $old_password = htmlspecialchars(strip_tags($_POST['old_password']));
        $new_password = htmlspecialchars(strip_tags($_POST['new_password']));
        unset($_POST);

        $m = new Database();
        if($m->check($name, $old_password) == true) {
            if($m->update($iduser, $name, $new_password) == true) {
                $_SESSION['loginstatus']['message'] = "Het wachtwoord van '" . $name . "' is succesvol geüpdated van'" . $old_password . "' naar '" . $new_password ."'!";
                header('location:../screens/client/client.php');
            } else {
                $_SESSION['loginstatus']['message'] = "Er is mogelijk iets misgegaan, probeer het opnieuw!";
                header('location:../screens/client/client.php');
            }
        } else {
            $_SESSION['loginstatus']['message'] = "oude wachtwoord is incorrect, probeer het opnieuw!";
            header('location:../screens/client/client.php');
        }
    }    
} 

// DELETE

if(isset($_POST['delete_user'])){
    if(!empty($_POST['iduser'])) {
        $iduser = htmlspecialchars(strip_tags($_POST['iduser']));
        $name = htmlspecialchars(strip_tags($_POST['name']));
        unset($_POST);

        $m = new Database();
        if($m->delete($iduser, $name) == true) {
            $_SESSION['loginstatus']['message'] = "'" . $name . "' is succesvol verwijderd uit het gebruikerssysteem!";
            header('location:../screens/client/client.php');
        } else {
            $_SESSION['loginstatus']['message'] = "Er is mogelijk iets misgegaan, probeer het opnieuw!";
            header('location:../screens/client/client.php');
        }
    }    
} 

// overige

if(isset($_POST['add_user'])){
    header('location:../screens/client/add_user.php');
}

if(isset($_POST['go_back'])){
    header('location:../screens/client/client.php');
}

if(isset($_POST['log_out'])){
    $_SESSION['loginstatus']['status'] = false;
    $_SESSION['loginstatus']['message'] = "Je bent succesvol uitgelogd " . $_SESSION['loginstatus']['username'] ."!";
    unset($_SESSION['loginstatus']['username']);
    header('location:../screens/login/index.php');  
} 



