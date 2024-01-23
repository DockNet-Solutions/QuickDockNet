<?php

use modele\jsonState;
use modele\bdd;


if(!(isset($_POST['password']) & isset($_POST['identifiant']))) {
    jsonState::returnNotif("error", "Error", "An internal error has occurred");
    return;
}

if(strlen($_POST['pseudo']) > 64 || strlen($_POST['email']) > 64 || strlen($_POST['password']) > 64) {
    jsonState::returnNotif("error", "Error", "Incomplete form");
    return;
}


$_POST['identifiant'] = htmlspecialchars($_POST['identifiant']); // can be pseudo or email

$bdd = bdd::getBdd();

$req = $bdd->prepare("SELECT * FROM users WHERE email=:email OR pseudo=:pseudo");
$req->execute(array("email" => $_POST['email'], "pseudo" => $_POST['pseudo']));
$info = $req->fetchAll(PDO::FETCH_ASSOC);

$flag = false;

if(isset($info) && !empty($info)) {
    foreach ($info as $d) {
        if(password_verify($_POST['password'], $d['password'])) {
            $_SESSION['User'] = $d;
            $_SESSION['User']['temp'] = time();


            jsonState::returnNotif("success", "Login successful!", "Welcome back ".$d['pseudo']."!");
            jsonState::returnJson("goUrl", "/login");
            $flag = true;
            break;
        }
    }
}

if(!$flag) {
    jsonState::returnNotif("error", "Error", "No account found with this pseudo/email.");
}