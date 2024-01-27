<?php
use modele\bdd;
use modele\jsonState;
use modele\Mail;


if(!isset($_POST['email'])) {
    jsonState::returnNotif("error", "Error", "An internal error has occurred");
    return;
}

$_POST["email"] = htmlspecialchars($_POST["email"]);

$bdd = bdd::getBdd();

$req = $bdd->prepare("SELECT * FROM users WHERE email=:email");
$req->execute(array("email" => $_POST["email"]));
$info = $req->fetch(PDO::FETCH_ASSOC);


if(isset($info) && !empty($info)) {

    $token = generateRandomToken(32);
    $req = $bdd->prepare("INSERT INTO `passRecover`( `token`, `email`, `createdAt`, `userId`) VALUES (:token,:email,:time,:id)");
    $req->execute(array("token" => $token, "email" => $info["email"], "time" => time(), "id" => $info["id"]));

    Mail::sendMail("Register your new password now ".$info["pseudo"],
        Mail::build("Register your password",
            " <a target=\"_blank\" href=\"http://localhost:80/index.php?page=emailForgotPwd&token=".$token."\">Setup new password</a> "),
        $info["email"], $info["pseudo"]);
    jsonState::returnNotif("success", "An email has just been sent to you", "");
    jsonState::returnJson("goUrl", "/home");
} else {
    jsonState::returnNotif("error", "Error", "No account found with this email");
}


function generateRandomToken($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!?';
    $charactersLength = strlen($characters);
    $randomToken = '';

    for ($i = 0; $i < $length; $i++) {
        $randomToken .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomToken;
}