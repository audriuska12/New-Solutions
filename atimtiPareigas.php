<?php
include "darbuotojas.php";
$darbuotojas = darbuotojas::getFromDatabase($_GET['darbuotojas']);
$darbuotojas->removePareigos($_GET['pareigos']);
pareigos::isvalyti();
header("Location: pareigosRodyti.php?id=".$_GET['darbuotojas']);