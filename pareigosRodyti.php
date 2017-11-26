<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="tables.css">
        <title>Kontaktai</title>
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
        $darbuotojas = darbuotojas::getFromDatabase($_GET['id']);
        $user = darbuotojas::getFromDatabase($_SESSION['userID']);
        $rusis = $user->getRusis()->pavadinimas;
        if ($rusis != "Parduotuvės vadovas" && $rusis != "Parduotuvių tinklo vadovas" && $user->id != $darbuotojas->id) {
            header("Location:accessDenied.php");
        }
        echo ($darbuotojas->pavarde . " " . $darbuotojas->vardas . " pareigos:</br>");
        $pareigos = $darbuotojas->getPareigos();
        $count = count($pareigos);
        if ($count > 0) {
            echo ("<table>");
            echo ("<tr><th>Pavadinimas</th><th>Stažas</th><th>Profesionalumo lygis</th><th>Sveikatos sutrikimai</th>" . (($user->arVirsesnis($darbuotojas)) ? "<th></th>" : "") . "</tr>");
            for ($i = 0; $i < $count; $i++) {
                echo ("<tr><td>" . $pareigos[$i]->pavadinimas . "</td><td>" . $pareigos[$i]->stazas . "</td><td>" . $pareigos[$i]->profesionalumo_lygis . "</td><td>" . $pareigos[$i]->sveikatos_sutrikimai . "</td>" . (($user->arVirsesnis($darbuotojas)) ? "<td><a href=\"atimtiPareigas.php?pareigos=" . $pareigos[$i]->id . "&darbuotojas=" . $_GET['id'] . "\" onclick=\"return confirm('Ar tikrai norite atimti šias pareigas?')\">Atimti</a></td>" : "") . "</tr>");
            }
            echo("</table>");
        } else {
            echo "Darbuotojas neturi pareigų</br>";
        }
        if ($user->arVirsesnis($darbuotojas) || ($rusis=="Parduotuvių tinklo vadovas" && $darbuotojas->id = $user->id)) {
            echo("<a href=\"suteiktiPareigas.php?id=$_GET[id]\">Suteikti naujas pareigas</a>");
        }
        ?>
    </body>
</html>
