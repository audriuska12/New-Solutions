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
$darbuotojas=darbuotojas::getFromDatabase($_GET['id']);
$grafikas=$darbuotojas->getGrafikas();
if($grafikas != NULL){
    echo($darbuotojas->pavarde." ".$darbuotojas->vardas." grafikas:</br>");
    echo("<table>");
    echo("<tr><th>Pirmadienis</th><th>Antradienis</th><th>Trečiadienis</th><th>Ketvirtadienis</th><th>Penktadienis</th><th>Šeštadienis</th><th>Sekmadienis</th></tr>");
    echo("<tr><td>".$grafikas->laikas_pirmad."</td><td>".$grafikas->laikas_antrad."</td><td>".$grafikas->laikas_treciad."</td><td>".$grafikas->laikas_ketvirtad."</td><td>".$grafikas->laikas_penktad."</td><td>".$grafikas->laikas_sestad."</td><td>".$grafikas->laikas_sekmad."</td></tr>");
    echo("</table>");
    echo "<a href=\"grafikasEdit.php?darbuotojas=".$_GET['id']."\">Redaguoti</a>";
} else {
    echo "Darbuotojas neturi grafiko!</br>";
    echo "<a href=\"grafikasCreate.php?darbuotojas=".$_GET['id']."\">Sukurti naują</a>";
}
