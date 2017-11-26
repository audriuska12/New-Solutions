<?php
$grupes=grupe::getPagalAdministratoriu($darbuotojas->id);
if($grupes != NULL){
    echo("<table>");
    echo("<tr><th>Pavadinimas</th><th>Sukūrimo data</th><th>Matomumas</th><th></th><th></th></tr>");
    $count=count($grupes);
    for($i=0; $i<$count; $i++){
        echo("<tr><td>".$grupes[$i]->pavadinimas."</td><td>".$grupes[$i]->sukurimo_data."</td><td>".(($grupes[$i]->matomumas == 1)? "Vieša":"Privati")."</td><td><a href=\"grupesNariai.php?id=".$grupes[$i]->id."\">Grupės nariai</a></td><td><a href=\"grupeKeistiAdministratoriu.php?id=".$grupes[$i]->id."\">Keisti administratorių</a></td></tr>");
    }
    echo("</table></br>");
} else{
    echo ($darbuotojas->pavarde. " ". $darbuotojas->vardas." neadministruoja jokių grupių.</br>");
}
echo ("<a href=\"grupeCreate.php?id=".$darbuotojas->id."\">Sukurti naują</a></br>");
