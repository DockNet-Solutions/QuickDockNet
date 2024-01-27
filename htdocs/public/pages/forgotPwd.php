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
                How it
                <span class="text-gradient">Works</span>
                ?
            </h1>
            <!-- Description -->
            <p class="overlay__description">
                First, enter the email address of the account you wish to retrieve. Then, an email will be sent to you: click on the link attached to it, and create your new password.
                <strong>It's that simple!</strong>
            </p>
        </div>
        
        

        <div class="login-div">
            <h1 class="overlay__title login-header">Forgot your password ?
            </h1>
            <hr>

            <strong>Email</strong>
            <input class="input-form-login" maxlength="64" id="email" type=text placeholder="email or username">
            <div class="buttons-form-login">
                <button onclick="sendRecover()" class="overlay__btn__1 overlay__btn--colors">
                    <span>Send Email</span>
                </button>
                <button onclick="window.location.href='/login';" class="overlay__btn__2 overlay__btn--colors">
                    <span>Back to Login</span>
                </button>
            </div>
            </form>
        </div>
    </div>

    <script>
        function sendRecover() {
            const email = document.getElementById("email").value;
            if(email.length < 64 && email.length > 0) {
                    fetch("/index.php?action=generateRecoverPassword", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({ email: email })
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