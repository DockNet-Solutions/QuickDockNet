<?php

use modele\bdd;

if(!isset($_GET['token'])) {
    header("Location: /login");
    return;
}

$_POST["token"] = htmlspecialchars($_POST["token"]);

$bdd = bdd::getBdd();

$req = $bdd->prepare("SELECT * FROM `passRecover` WHERE token=:token");
$req->execute(array("token"=>$_POST["token"]));
$info = $req->fetch(PDO::FETCH_ASSOC);

if(time() - 10*60 > $info["createAt"]) {
    echo 'This link has expired.';
    exit();
}
?>

<!-- Overlay -->
<!-- Canvas -->
<canvas class="orb-canvas"></canvas>
<!-- Overlay -->
<div class="overlay changepwd__container">
    <div class="header-login">
        <h1 class="overlay__title-DockNet">

            <span class="text-gradient-Quick">Quick</span>DockNet
        </h1>
    </div>
    <div class="content-login changepwd">
        <!-- Overlay inner wrapper -->
        <div class="overlay__inner">
            <h1 class="overlay__title login-header">Create a new Password</h1>
            <hr>

            <strong class="pwd">New Password</strong>
            <input id="newpass" maxlength="64" class="input-form-login" type="password" placeholder="new password">
            <input id="newpass2" maxlength="64" class="input-form-login" type="password" placeholder="re-type new password">
            <div class="buttons-form-login">
                <button onclick="sendChangePass()" class="overlay__btn__1 overlay__btn--colors">
                    <span>Save</span>
                </button>
        </div>
        </div>
    </div>

    <script>
        function sendChangePass() {
            const new_password = document.getElementById("newpass").value;
            const new_password2 = document.getElementById("newpass2").value;
            if(new_password.length < 64 && new_password.length >= 12 && new_password2.length < 64 && new_password2.length >= 12
            && new_password === new_password2) {
                    fetch("/index.php?action=recoverPassword", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({ new_password: new_password, })
                    }).then(data => data.json()).then(json => {
                        console.log(json);
                        if(json.toastr) {
                            toastr[json.status](json.message, json.header);
                        }
                        if(json.goUrl) {
                            setTimeout(function () {
                                window.open(json.goUrl,"_self");
                            }, 3000);
                        }
                    });
            }else {
                toastr["error"]("Incomplete form", "Erreur");
            }
        }
    </script>