<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="tables.css">
    </head>
    <body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "darbuotojas.php";
if (!isset($_SESSION['userID'])) {
    header("Location:accessDenied.php");
}
$user=darbuotojas::getFromDatabase($_SESSION['userID']);
$darbuotojas=darbuotojas::getFromDatabase($_GET['id']);
echo($darbuotojas->pavarde." ".$darbuotojas->vardas." gautos pastabos:");
$pastabos=$darbuotojas->getGautosPastabosViesos($_SESSION['userID']);
$count=count($pastabos);
if($count>0){
    echo("<table>");
    echo("<tr><th>Rašė</th><th>Data</th><th>Matomumas</th><th>Tekstas</th></tr>");
    for($i=0; $i<$count; $i++){
        $rasytojas=darbuotojas::getFromDatabase($pastabos[$i]->rasytojas);
        echo("<tr><td>".$rasytojas->pavarde." ".$rasytojas->vardas."</td><td>".$pastabos[$i]->rasymo_data."</td><td>".(($pastabos[$i]->viesa == 1)? "Vieša":"Privati")."</td><td>".$pastabos[$i]->tekstas."</td></tr>");
    }
    echo("</table>");
}
echo ("</br>");
if($user->arVirsesnis($darbuotojas)){
echo("<a href=\"pastabaRasyti.php?id=".$darbuotojas->id."\">Rašyti naują</a>");}

