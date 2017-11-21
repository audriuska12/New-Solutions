<?php
include "grupe.php";
$grupe = grupe::getFromDatabase($_GET['grupe']);
$grupe->removeDarbuotojas($_GET['id']);
header("Location: grupesNariai.php?id=".$_GET['grupe']);

