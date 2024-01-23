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
                Register
            </h1>
            <!-- Description -->
            <p class="overlay__description">
                The security of your information is our top priority. When you register on our site, rest assured that <strong>your passwords are fully encrypted</strong> in our database.
                We use <strong>advanced encryption techniques</strong> to ensure that your information remains confidential and secure.
            </p>
        </div>

        <div class="login-div">
            <h1 class="overlay__title login-header">Create an account</h1>
            <hr>

            <strong>Pseudo</strong>
            <input id="reg-pseudo" maxlength="32" class="input-form-login" type="text" placeholder="Pseudonyme">

            <strong>Email</strong>
            <input id="reg-email" maxlength="64" class="input-form-login" type="email" placeholder="email">
            <strong class="pwd">Password</strong>
            <input id="reg-password" maxlength="64" class="input-form-login" type="password" placeholder="password">
            <input id="reg-password2" maxlength="64" class="input-form-login" type="password" placeholder="re-type password">
            <div class="buttons-form-login">
                <button onClick="window.location.href='/login';" class="overlay__btn__2 overlay__btn--colors">
                    <span>Login</span>
                </button>
                <button onclick="sendRegister()" class="overlay__btn__1 overlay__btn--colors">
                    <span>Register</span>
                </button>
            </div>
            </form>
        </div>
    </div>

    <script>
        function sendRegister() {
            const email = document.getElementById("reg-email").value;
            const password = document.getElementById("reg-password").value;
            const password2 = document.getElementById("reg-password2").value;
            const pseudo = document.getElementById("reg-pseudo").value;
            if(email.length < 64 && email.length > 0 && pseudo.length < 64 && pseudo.length > 0 && password.length < 64 && password.length >= 8) {
                if(password === password2) {
                    fetch("/index.php?action=register", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({ email: email, password: password, pseudo: pseudo })
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
                } else {
                    toastr["error"]("Passwords not matching", "Error");
                }
            }else {
                toastr["error"]("Incomplete form", "Erreur");
            }
        }
    </script>