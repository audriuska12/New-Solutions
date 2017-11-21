<?php
include "darbuotojas.php";
$darbuotojas= darbuotojas::getFromDatabase($_POST['darbuotojas']);
if($_POST['pareigos']!=0){
    $darbuotojas->addPareigos($_POST['pareigos']);
} else{
    $id=pareigos::addToDatabase($_POST['pavadinimas'], $_POST['stazas'], $_POST['profesionalumo_lygis'], $_POST['sveikatos_sutrikimai']);
    $darbuotojas->addPareigos($id);
}
header("Location: pareigosRodyti.php?id=".$_POST['darbuotojas']);
