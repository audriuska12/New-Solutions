<?php
include "darbuotojas.php";
$darbuotojas = darbuotojas::getFromDatabase($_GET['id']);
$darbuotojas->atleisti();
pareigos::isvalyti();
header("Location: darbuotoju_sarasas.php");
