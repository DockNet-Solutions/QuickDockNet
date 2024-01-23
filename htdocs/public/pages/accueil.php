<?php
if(!isset($_SESSION['User'])) { // if not connected
    header('Location: /login'); // forward to login page
}
?>

<div class="accueil">
    <h1>Home</h1>
    <button onclick="window.location.href='/changePwd';" class="overlay__btn__2 overlay__btn--colors resetpwd">
        <span>Change Password</span>
    </button>
</div>
