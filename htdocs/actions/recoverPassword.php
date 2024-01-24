<?php

use modele\bdd;
use modele\jsonState;

if(!isset($_POST['token']) || !isset($_POST["password"])) {
    jsonState::returnNotif("error", "Error", "An internal error has occurred");
    return;
}

$_POST["token"] = htmlspecialchars($_POST["token"]);

$bdd = bdd::getBdd();

$req = $bdd->prepare("SELECT * FROM `passRecover` WHERE token=:token");
$req->execute(array("token"=>$_POST["token"]));
$info = $req->fetch(PDO::FETCH_ASSOC);

if(time() - 10*60 < $info["createAt"]) {

    $req = $bdd->prepare("UPDATE `users` SET `password`=:newpassword WHERE id=:id");
    $req->execute(array("id" => $info["id"], "newpassword" => $_POST["password"]));
    jsonState::returnNotif("Success", "Password change successfully", "");
    jsonState::returnJson("goUrl", "/home");
} else {
    jsonState::returnNotif("error", "Error", "Le lien a expiré");
}