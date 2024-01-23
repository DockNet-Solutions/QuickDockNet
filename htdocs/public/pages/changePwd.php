<?php
if(!isset($_SESSION['User'])) { // if not connected
    header('Location: /login'); // forward to login page
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
            <h1 class="overlay__title login-header">Change your password</h1>
            <hr>
            <strong>Old Password</strong>
            <input id="oldpass" maxlength="64" class="input-form-login" type="password" placeholder="password">

            <strong class="pwd">New Password</strong>
            <input id="newpass" maxlength="64" class="input-form-login" type="password" placeholder="new password">
            <input id="newpass2" maxlength="64" class="input-form-login" type="password" placeholder="re-type new password">
            <div class="buttons-form-login">
                <button onclick="sendChangePass()" class="overlay__btn__1 overlay__btn--colors">
                    <span>Change it !</span>
                </button>
                <button onclick="window.location.href='/home';" class="overlay__btn__2 overlay__btn--colors">
                    <span>Back to Home</span>
                </button>
        </div>
        </div>
    </div>

    <script>
        function sendChangePass() {
            const new_password = document.getElementById("newpass").value;
            const new_password2 = document.getElementById("newpass2").value;
            const old_password = document.getElementById("oldpass").value;
            if(new_password.length < 64 && new_password.length >= 12 && new_password2.length < 64 && new_password2.length >= 12 && old_password.length < 64 && old_password.length > 0) {
                    fetch("/index.php?action=changePassword", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({ new_password: new_password, old_password: old_password })
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