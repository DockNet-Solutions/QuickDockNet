<?php

use modele\jsonState;
use modele\bdd;


if(!(isset($_POST['old_password']) && isset($_POST['old_password']) && isset($_SESSION["User"]))) {
    jsonState::returnNotif("error", "Error", "An internal error has occurred");
    return;
}

if(strlen($_POST['old_password']) > 64 || strlen($_POST['new_password']) > 64) {
    jsonState::returnNotif("error", "Error", "Incomplete form");
    return;
}

$bdd = bdd::getBdd();

$req = $bdd->prepare("SELECT * FROM users WHERE email=:email OR pseudo=:pseudo");
$req->execute(array("email" => $_POST['identifiant'], "pseudo" => $_POST['identifiant']));
$info = $req->fetchAll(PDO::FETCH_ASSOC);

$flag = false;

if(isset($info) && !empty($info)) {
    foreach ($info as $d) {
        if(password_verify($_POST['password'], $d['password'])) {
            $_SESSION['User'] = $d;
            $_SESSION['User']['temp'] = time();


            jsonState::returnNotif("success", "Login successful!", "Welcome back ".$d['pseudo']."!");
            jsonState::returnJson("goUrl", "/accueil");
            $flag = true;
            break;
        }
    }
}

if(!$flag) {
    jsonState::returnNotif("error", "Error", "No account found with this pseudo/email/password.");
}