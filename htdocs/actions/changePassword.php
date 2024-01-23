<?php

use modele\jsonState;
use modele\bdd;


if(!(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_SESSION["User"]))) {
    jsonState::returnNotif("error", "Error", "An internal error has occurred");
    return;
}

if(strlen($_POST['old_password']) > 64 || strlen($_POST['new_password']) > 64) {
    jsonState::returnNotif("error", "Error", "Incomplete form");
    return;
}

$bdd = bdd::getBdd();

$req = $bdd->prepare("SELECT * FROM users WHERE id=:id");
$req->execute(array("id" => $_SESSION["User"]["id"]));
$info = $req->fetchAll(PDO::FETCH_ASSOC);

if(password_verify($_POST["old_password"], $info["password"])) {
    $req = $bdd->prepare("UPDATE `users` SET `password`=:newpassword WHERE id=:id");
    $req->execute(array("id" => $_SESSION["User"]["id"], "newpassword" => password_hash($_POST["new_password"], PASSWORD_DEFAULT)));
    jsonState::returnNotif("Success", "Password change successfully", "");
} else {
    jsonState::returnNotif("error", "Error", "Old password don't match");
}

$flag = false;

