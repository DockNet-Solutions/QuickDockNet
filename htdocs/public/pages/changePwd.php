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
            <strong>Password</strong>
            <input id="reg-password" maxlength="64" class="input-form-login" type="password" placeholder="password">

            <strong class="pwd">New Password</strong>
            <input id="reg-password" maxlength="64" class="input-form-login" type="password" placeholder="new password">
            <input id="reg-password2" maxlength="64" class="input-form-login" type="password" placeholder="re-type new password">
            <div class="buttons-form-login">
                <button onclick="#;" class="overlay__btn__1 overlay__btn--colors">
                    <span>Change it !</span>
                </button>
                <button onclick="window.location.href='/home';" class="overlay__btn__2 overlay__btn--colors">
                    <span>Back to Home</span>
                </button>
        </div>
        </div>
    </div>

    <script>
        function sendLogin() {
            const identifiant = document.getElementById("log-identifiant").value;
            const password = document.getElementById("log-password").value;
            if(identifiant.length < 64 && identifiant.length > 0 && password.length < 64 && password.length > 0) {
                    fetch("/index.php?action=login", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({ identifiant: identifiant, password: password })
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