<?php
include "darbuotojas.php";
$darbuotojas= darbuotojas::getFromDatabase($_POST['darbuotojas']);
$id=pareigos::addToDatabase($_POST['pavadinimas'], $_POST['stazas'], $_POST['profesionalumo_lygis'], $_POST['sveikatos_sutrikimai']);
$darbuotojas->addPareigos($id);
header("Location: pareigosRodyti.php?id=".$_POST['darbuotojas']);
