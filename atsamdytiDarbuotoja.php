<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "darbuotojas.php";
if (!isset($_SESSION['userID'])) {
    header("Location:accessDenied.php");
}
$user = darbuotojas::getFromDatabase($_SESSION['userID']);
$rusis = $user->getRusis()->pavadinimas;
if (!($rusis == "Parduotuvės vadovas" || $rusis == "Parduotuvių tinklo vadovas")) {
    header("Location:accessDenied.php");
} else {
    $darbuotojas = darbuotojas::getFromDatabase($_GET['id']);
    if (!$user->arVirsesnis($darbuotojas)) {
        header("Location:accessDenied.php");
    } else {
        $darbuotojas->atsamdyti();
        header("Location: darbuotoju_sarasas.php");
    }
}
