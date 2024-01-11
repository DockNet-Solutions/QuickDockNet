<?php

use modele\jsonState;

unset($_SESSION);
session_destroy();
jsonState::returnNotif("success", "déconnexion réussie !", "");
jsonState::returnJson("refresh", true);
?>