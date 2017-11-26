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
        $darbuotojas = darbuotojas::getFromDatabase($_SESSION['userID']);
        $darbuotojas = darbuotojas::getFromDatabase($_GET['id']);
        $rusis = $darbuotojas->getRusis()->pavadinimas;
        if (!($rusis == "Parduotuvės vadovas" || $rusis == "Parduotuvių tinklo vadovas") || !$darbuotojas->arVirsesnis($darbuotojas)) {
            header("Location:accessDenied.php");
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['pareigos'] != 0) {
                    $darbuotojas->addPareigos($_POST['pareigos']);
                } else {
                    $id = pareigos::addToDatabase($_POST['pavadinimas'], $_POST['stazas'], $_POST['profesionalumo_lygis'], $_POST['sveikatos_sutrikimai']);
                    $darbuotojas->addPareigos($id);
                }
                header("Location: pareigosRodyti.php?id=" . $_GET['id']);
            }
        }
        ?>

        <form action ="suteiktiPareigas.php?id=<?php echo $_GET['id'] ?>" method="post">
            <table>
                <tr><th>Parinkti esamas:</th><td><select name="pareigos">
                            <option value="0"></option>
                            <?php
                            $darb = darbuotojas::getFromDatabase($_GET['id']);
                            $pareigos = $darb->getNeturimosPareigos();
                            $count = count($pareigos);
                            for ($i = 0; $i < $count; $i++) {
                                echo("<option value=\"" . $pareigos[$i]->id . "\">" . $pareigos[$i]->pavadinimas . "</option>");
                            }
                            ?>
                        </select></td></tr>
                <tr><td>Kurti naujas:</td></tr>
                <tr><th>Pavadinimas:</th><td><input type="text" name="pavadinimas"></input></td></tr>
                <tr><th>Stažas:</th><td><input type="number" name="stazas" value="0" min="0"></input></td></tr>
                <tr><th>Profesionalumo lygis:</th><td><input type="text" name="profesionalumo_lygis"></input></td></tr>
                <tr><th>Sveikatos sutrikimai:</th><td><input type="text" name="sveikatos_sutrikimai"></input></td></tr>
            </table>
            <input type="submit" value="Patvirtinti"></input>
        </form></br>
        <a href="pareigosRodyti.php?id=<?php echo $_GET['id'] ?>">Atgal</a>
    </body>
</html>