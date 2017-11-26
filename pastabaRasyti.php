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
        if ($rusis != "Parduotuvės vadovas" && $rusis != "Parduotuvių tinklo vadovas") {
            header("Location:accessDenied.php");
        }
        if (isset($_POST['tekstas'])) {
            pastaba::addToDatabase($_POST['viesa'], $_POST['tekstas'], $_SESSION['userID'], $_GET['id']);
            header("Location: pastabosViesos.php?id=" . $_GET['id']);
        }
        ?>
        <form action="pastabaRasyti.php?id=<?php echo$_GET['id'] ?>" method="post">
            <table>
                <tr><th>Tekstas:</th><td><input type="text" name="tekstas"></input></td></tr>
            <tr><th>Matomumas:</th><td><select name="viesa">
                <option value="0">Privati</option>
                <option value="1">Vieša</option>
            </select></td></tr>
            </table>
            <input type="submit" value="Įrašyti"></input>
        </form>
        <a href="pastabosViesos.php?id=<?php echo $_GET['id'];?>">Atgal</a>
    </body>
</html>