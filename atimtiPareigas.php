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
    $darbuotojas = darbuotojas::getFromDatabase($_GET['darbuotojas']);
    if(!($user->arVirsesnis($darbuotojas) || $user->id==$darbuotojas->id)){
       header("Location:accessDenied.php"); 
    } else{
        $darbuotojas->removePareigos($_GET['pareigos']);
        header("Location: pareigosRodyti.php?id=" . $_GET['darbuotojas']);
    }
}