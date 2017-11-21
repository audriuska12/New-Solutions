<?php
include "darbuotojas.php";
include "grupe.php";
$darbuotojas=darbuotojas::getFromDatabase($_GET['id']);
$grupes=grupe::getPagalAdministratoriu($darbuotojas->id);
if($grupes != NULL){
    echo("Jūsų administruojamos grupės:</br>");
    echo("<table>");
    echo("<tr><th>Pavadinimas</th><th>Sukūrimo data</th><th>Matomumas</th></tr>");
    $count=count($grupes);
    for($i=0; $i<$count; $i++){
        echo("<tr><td>".$grupes[$i]->pavadinimas."</td><td>".$grupes[$i]->sukurimo_data."</td><td>".(($grupes[$i]->matomumas == 1)? "Vieša":"Privati")."</td><td><a href=\"grupesNariai.php?id=".$grupes[$i]->id."\">Grupės nariai</a></td><td><a href=\"grupeKeistiAdministratoriu.php?id=".$grupes[$i]->id."\">Keisti administratorių</a></td></tr>");
    }
    echo("</table></br>");
} else{
    echo ($darbuotojas->pavarde. " ". $darbuotojas->vardas." neadministruoja jokių grupių.</br>");
}
echo ("<a href=\"grupeCreate.php?id=".$darbuotojas->id."\">Sukurti naują</a>");
