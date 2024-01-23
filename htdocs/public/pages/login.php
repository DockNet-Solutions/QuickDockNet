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
        </div>

        <div class="login-div">
            <h1 class="overlay__title login-header">Login to your account</h1>
            <hr>

            <strong>Email</strong>
            <input class="input-form-login" maxlength="64" id="log-identifiant" type=text placeholder="email or username">
            <strong class="pwd">Password</strong>
            <input class="input-form-login" maxlength="64" id="log-password" type="password" placeholder="password">
            <div class="buttons-form-login">
                <button onclick="sendLogin();" class="overlay__btn__1 overlay__btn--colors">
                    <span>Login</span>
                </button>
                <button onclick="window.location.href='/register';" class="overlay__btn__2 overlay__btn--colors">
                    <span>Register</span>
                </button>
            </div>
            </form>
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
                            }, 1000);
                        }
                    });
            }else {
                toastr["error"]("Incomplete form", "Erreur");
            }
        }
    </script>