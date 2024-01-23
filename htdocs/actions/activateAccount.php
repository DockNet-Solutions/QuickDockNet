<?php

use modele\bdd;

if(!isset($_GET["account"])) {
    echo 'unknow error';
} else {


    $bdd = bdd::getBdd();
    $_GET["account"] = htmlspecialchars($_GET["account"]);

    $req = $bdd->prepare("SELECT * FROM users WHERE id=:id");
    $req->execute(array("id"=>$_GET["account"]));
    $info = $req->fetchAll(PDO::FETCH_ASSOC);

    if(isset($info) && !empty($info)) {
        $req = $bdd->prepare("UPDATE `users` SET `active`=1 WHERE id=:id");
        $req->execute(array("id" => $_GET["account"]));
        echo 'your account is now activated, you can close this tab';
    } else {
        echo 'no account found with this id';
    }

}