<?php
include "darbuotojas.php";
$darbuotojas=darbuotojas::getFromDatabase($_GET['id']);
echo ($darbuotojas->pavarde." ".$darbuotojas->vardas." pareigos:</br>");
$pareigos=$darbuotojas->getPareigos();
$count=count($pareigos);
if ($count > 0) {
    echo ("<table>");
    echo ("<tr><th>Pavadinimas</th><th>Stažas</th><th>Profesionalumo lygis</th><th>Sveikatos sutrikimai</th></tr>");
    for($i = 0; $i <$count; $i++){
        echo ("<tr><td>".$pareigos[$i]->pavadinimas."</td><td>".$pareigos[$i]->stazas."</td><td>".$pareigos[$i]->profesionalumo_lygis."</td><td>".$pareigos[$i]->sveikatos_sutrikimai."</td><td><a href=\"atimtiPareigas.php?pareigos=" . $pareigos[$i]->id . "&darbuotojas=".$_GET['id']."\" onclick=\"return confirm('Ar tikrai norite atimti šias pareigas?')\">Atimti</a></td></tr>");
    }
    echo("</table>");
} else {
    echo "Darbuotojas neturi pareigų</br>";
}
echo("<a href=\"suteiktiPareigas.php?id=$_GET[id]\">Suteikti naujas pareigas</a>");
