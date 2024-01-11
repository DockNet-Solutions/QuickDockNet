<?php 

use modele\jsonState;
use modele\bdd;

if(!(isset($_POST['password']) & isset($_POST['email']) & isset($_POST['pseudo']))) {
    jsonState::returnNotif("error", "Erreur", "Une erreur interne est survenue.");
    return;
}

if(strlen($_POST['password']) < 12) {
    jsonState::returnNotif("error", "Erreur", "Le mot de passe doit faire plus de 6 caractères !");
    return;
}

if(!preg_match('/[0-9A-Z]/', $str)) {
    jsonState::returnNotif("error", "Erreur", "Le mot de passe doit contenir un chiffre et une majuscule !");
    return;
}

$_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
$_POST['email'] = htmlspecialchars($_POST['email']);

$bdd = bdd::getBdd();


$req = $bdd->prepare("SELECT * FROM users WHERE email=:email OR pseudo=:pseudo");
$req->execute(array("email" => $_POST['email'], "pseudo" => $_POST['pseudo']));
$info = $req->fetchAll(PDO::FETCH_ASSOC);

if(isset($info) && !empty($info)) {
    foreach($info as $d) {
        if($d['pseudo'] == $_POST['pseudo']) {
            jsonState::returnNotif("error", "Erreur", "Un compte avec ce pseudo existe déjà.");
            return;
        } else if($d['email'] == $_POST['email']) {
            jsonState::returnNotif("error", "Erreur", "Un compte avec cet email existe déjà.");
            return;
        }
    }
    jsonState::returnNotif("error", "Erreur", "Un compte ces identifiants existe déjà.");
} else { 
    $req = $bdd->prepare("INSERT INTO users (pseudo, email, password, joinDate) VALUES (:pseudo, :email, :password, :joinDate)");
    $req->execute(array("pseudo" => $_POST['pseudo'], "email" => $_POST['email'], "password" => password_hash($_POST['password'], PASSWORD_DEFAULT), "joinDate" => time());
    
    $req = $this->bdd->prepare("SELECT * FROM users WHERE pseudo=:pseudo");
    $req->execute(array("pseudo" => $_POST['pseudo']));
    $_SESSION['User'] = $this->info = $req->fetch(PDO::FETCH_ASSOC);
    $_SESSION['User']['temp'] = time();
        
    
    jsonState::returnNotif("success", "Enregistrement réussie !", "Bienvenue sur Docknet !");
    jsonState::returnJson("refresh", true);
}
?>