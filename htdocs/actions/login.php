<?php

use modele\jsonState;
use modele\bdd;



if(!(isset($_POST['password']) & isset($_POST['identifiant']) & isset($_POST['captcha']))) {
    jsonState::returnNotif("error", "Error", "An internal error has occurred");
    return;
}

if(strlen($_POST['identifiant']) > 64 || strlen($_POST['password']) > 64) {
    jsonState::returnNotif("error", "Error", "Incomplete form");
    return;
}

if($_SESSION["captcha_login"] != $_POST['captcha']) {
    jsonState::returnNotif("error", "Error", "Wrong captcha");
    return;
}


$_POST['identifiant'] = htmlspecialchars($_POST['identifiant']); // can be pseudo or email

$bdd = bdd::getBdd();

$req = $bdd->prepare("SELECT * FROM users WHERE email=:email OR pseudo=:pseudo");
$req->execute(array("email" => $_POST['identifiant'], "pseudo" => $_POST['identifiant']));
$info = $req->fetchAll(PDO::FETCH_ASSOC);

$flag = false;

if(isset($info) && !empty($info)) {
    foreach ($info as $d) {
        if(password_verify($_POST['password'], $d['password'])) {

            if($d["active"] == 0) { // account not activated
                jsonState::returnNotif("error", "Error", "Account not activated, look at your email.");
            } else {

                $_SESSION['User'] = $d;
                $_SESSION['User']['temp'] = time();


                jsonState::returnNotif("success", "Login successful!", "Welcome back " . $d['pseudo'] . "!");
                jsonState::returnJson("goUrl", "/home");
            }
            $flag = true;
            break;
        }
    }
}

if(!$flag) {
    jsonState::returnNotif("error", "Error", "No account found with this pseudo/email/password.");
}