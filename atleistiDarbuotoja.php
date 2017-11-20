<?php
include "darbuotojas.php";
$darbuotojas = darbuotojas::getFromDatabase($_GET['id']);
var_dump($darbuotojas);
$darbuotojas->atleisti();
var_dump($darbuotojas);
die;
header("Location: darbuotoju_sarasas.php");

