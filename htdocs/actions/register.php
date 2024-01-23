<?php 

use modele\jsonState;
use modele\bdd;
use modele\Mail;


if(!(isset($_POST['password']) & isset($_POST['email']) & isset($_POST['pseudo']))) {
    jsonState::returnNotif("error", "Error", "An internal error has occurred");
    return;
}

if(strlen($_POST['password']) < 8) {
    jsonState::returnNotif("error", "Error", "The password must be longer than 8 characters!");
    return;
}

$_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
$_POST['email'] = htmlspecialchars($_POST['email']);

if(strlen($_POST['pseudo']) > 64 || strlen($_POST['email']) > 64 || strlen($_POST['password']) > 64) {
    jsonState::returnNotif("error", "Error", "Incomplete form");
    return;
}


if(!preg_match('/[0-9A-Z]/', $_POST['password'])) {
    jsonState::returnNotif("error", "Error", "The password must contain a number and an uppercase letter!");
    return;
}


$bdd = bdd::getBdd();


$req = $bdd->prepare("SELECT * FROM users WHERE email=:email OR pseudo=:pseudo");
$req->execute(array("email" => $_POST['email'], "pseudo" => $_POST['pseudo']));
$info = $req->fetchAll(PDO::FETCH_ASSOC);

if(isset($info) && !empty($info)) {
    foreach($info as $d) {
        if($d['pseudo'] == $_POST['pseudo']) {
            jsonState::returnNotif("error", "Error", "An account with this nickname already exists.");
            return;
        } else if($d['email'] == $_POST['email']) {
            jsonState::returnNotif("error", "Error", "An account with this email already exists.");
            return;
        }
    }
    jsonState::returnNotif("error", "Error", "An account with these identifiers already exists.");
} else { 
    $req = $bdd->prepare("INSERT INTO users (pseudo, email, password, joinDate) VALUES (:pseudo, :email, :password, :joinDate)");
    $req->execute(array("pseudo" => $_POST['pseudo'], "email" => $_POST['email'], "password" => password_hash($_POST['password'], PASSWORD_DEFAULT), "joinDate" => time()));
    
    $req = $bdd->prepare("SELECT * FROM users WHERE pseudo=:pseudo");
    $req->execute(array("pseudo" => $_POST['pseudo']));
    $_SESSION['User'] = $req->fetch(PDO::FETCH_ASSOC);
    $_SESSION['User']['temp'] = time();

    Mail::sendMail("Welcome ".$_SESSION['pseudo']." to DockNet !",
        Mail::build("Welcome to DockNet !",
            "Thanks for joining us ! <a href='localhost:80/index.php?action=activateAccount&account=".$_SESSION['User']["id"]."'>Activate your account now !</a> "),
        $_SESSION['email'], $_SESSION['pseudo']);
        
    
    jsonState::returnNotif("success", "Registration successful!", "Welcome to Docknet!");
    jsonState::returnJson("goUrl", "/login");
}
?>