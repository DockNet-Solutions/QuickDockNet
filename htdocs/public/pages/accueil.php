<?php
if(!isset($_SESSION['User'])) { // if not connected
    header('Location: /login'); // forward to login page
}
?>

<h1>Accueil</h1>
