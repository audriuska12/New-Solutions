<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "darbuotojas.php";
if (!isset($_SESSION['userID'])) {
    header("Location:accessDenied.php");
}
include "grupe.php";
$grupe = grupe::getFromDatabase($_GET['grupe']);
if ($grupe->administratorius == $_SESSION['userID']) {
    $grupe->removeDarbuotojas($_GET['id']);
    header("Location: grupesNariai.php?id=" . $_GET['grupe']);
} else {
    header("Location:accessDenied.php");
}

