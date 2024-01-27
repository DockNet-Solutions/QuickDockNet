<?php
use modele\PureCaptcha;
?>

<!-- Overlay -->
<!-- Canvas -->
<canvas class="orb-canvas"></canvas>
<!-- Overlay -->
<div class="overlay">
    <div class="header-login">
        <h1 class="overlay__title-DockNet">

            <span class="text-gradient-Quick">Quick</span>DockNet
        </h1>
    </div>
    <div class="content-login">
        <!-- Overlay inner wrapper -->
        <div class="overlay__inner">
            <!-- Title -->
            <h1 class="overlay__title">

                <span class="text-gradient">Secure</span>
                Connexion
            </h1>
            <!-- Description -->
            <p class="overlay__description">
                Protecting your data and securing your connection are at the heart of our commitment. We're proud to support you in your quest for a <strong>safe and serene online experience.</strong> Welcome to an era where the security of your connection is
                <strong>our top priority...</strong>
            </p>
            <div class="buttons-form-login">
                <button onclick="sendLogin();" class="overlay__btn__1 overlay__btn--colors">
                    <span>Connect</span>
                </button>
                <button onclick="window.location.href='/register';" class="overlay__btn__2 overlay__btn--colors">
                    <span>Register</span>
                </button>
            </div>
        </div>

        <div class="login-div">
            <h1 class="overlay__title login-header">Login to your account</h1>
            <hr>

            <strong>Email</strong>
            <input class="input-form-login" maxlength="64" id="log-identifiant" type=text placeholder="email or username">
            <strong class="pwd">Password</strong>
            <input class="input-form-login" maxlength="64" id="log-password" type="password" placeholder="password">
            <hr style="margin-top:0;border-color:black;"/>
            <div style="text-align: center">
                <img style="height:70px;" src='<?php
                $p = new PureCaptcha();
                $_SESSION["captcha_login"] = $p->show();
                ?>' height='22'/>
            </div>

            <strong>Captcha:</strong>
            <input class="input-form-login" maxlength="10" id="captcha" type="text" placeholder="code">

            <div class="buttons-form-login btn__forgotpwd">
                <a href='/forgotPwd'>Forgot your password ?</a>
            </div>
        </div>
    </div>

    <script>
        function sendLogin() {
            const identifiant = document.getElementById("log-identifiant").value;
            const password = document.getElementById("log-password").value;
            const captcha = document.getElementById("captcha").value;
            if(identifiant.length < 64 && identifiant.length > 0 && password.length < 64 && password.length >= 12 && captcha.length > 0 && captcha.length < 10) {
                    fetch("/index.php?action=login", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({ identifiant: identifiant, password: password, captcha: captcha })
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