<?php
include "darbuotojas.php";
$darbuotojas = darbuotojas::getFromDatabase($_GET['id']);
$darbuotojas->atsamdyti();
header("Location: darbuotoju_sarasas.php");

