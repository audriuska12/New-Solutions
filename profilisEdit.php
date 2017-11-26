<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="tables.css">
        <title>Profilio redagavimas</title>
    </head>
    <body>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        include "darbuotojas.php";
        if (!isset($_SESSION['userID'])) {
            header("Location:accessDenied.php");
        } else {
            $user = darbuotojas::getFromDatabase($_SESSION['userID']);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                darbuotojas::update($_GET['id'], $_POST['vardas'], $_POST['pavarde'], $_POST['tel_nr'], $_POST['el_pastas'], $_POST['adresas'], $_POST['alga'], $_POST['finansai'], $_POST['rusis']);
                echo "<script>window.onunload = refreshParent;function refreshParent(){window.opener.location.reload();}</script>";
                echo "<script>window.close();</script>";
            } else {
                $darbuotojas = darbuotojas::getFromDatabase($_GET['id']);
                if (!($user->arVirsesnis($darbuotojas) && $user->getRusis()->pavadinimas == "Parduotuvių tinklo vadovas")) {
                    header("Location:accessDenied.php");
                } else {
                    echo("<form action=\"profilisEdit.php?id=" . $_GET['id'] . "\" method=\"POST\">");
                    echo("<table>");
                    echo("<tr><th>Vardas:</th><td><input name=\"vardas\" type=\"text\" value=\"" . $darbuotojas->vardas . "\"></input></td></tr>");
                    echo("<tr><th>Pavardė:</th><td><input name=\"pavarde\" type=\"text\" value=\"" . $darbuotojas->pavarde . "\"></input></td></tr>");
                    echo("<tr><th>Telefono numeris:</th><td><input name=\"tel_nr\" type=\"text\" value=\"" . $darbuotojas->tel_nr . "\"></input></td></tr>");
                    echo("<tr><th>El. paštas:</th><td><input name=\"el_pastas\" type=\"text\" value=\"" . $darbuotojas->el_pastas . "\"></input></td></tr>");
                    echo("<tr><th>Adresas:</th><td><input name=\"adresas\" type=\"text\" value=\"" . $darbuotojas->adresas . "\"></input></td></tr>");
                    echo("<tr><th>Alga:</th><td><input name=\"alga\" type=\"numeric\" min=\"0\"value=\"" . $darbuotojas->alga . "\"></input></td></tr>");
                    echo("<tr><th>Finansai:</th><td><select name=\"finansai\">");
                    $finansai = darbuotoju_finansai::getDarbuotojuFinansai();
                    $count = count($finansai);
                    for ($i = 0; $i < $count; $i++) {
                        echo("<option value=\"" . $finansai[$i]->id . "\">" . $finansai[$i]->id . "</option>");
                    }
                    echo ("</selec>");
                    echo("<tr><th>Pozicija:</th>");
                    echo("<td><select name=\"rusis\">");
                    echo("<option value=\"1\">Darbuotojas</option>");
                    if ($user->getRusis()->pavadinimas == "Parduotuvių tinklo vadovas") {
                        echo("<option value=\"2\">Parduotuvės vadovas</option>");
                        echo("<option value=\"3\">Parduotuvių tinklo vadovas</option>");
                    }
                    echo("</select></td></tr>");
                    echo("</table>");
                    echo("<input type=\"submit\" value=\"Išsaugoti\"></input>");
                    echo("</form>");
                }
            }
        }
        ?>
    </body>
</hml>

