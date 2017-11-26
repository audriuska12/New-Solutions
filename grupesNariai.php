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
        include "linksDarbuotojai.php";
        include "darbuotojas.php";
        if (!isset($_SESSION['userID'])) {
            header("Location:accessDenied.php");
        }
        include "grupe.php";
        $grupe = grupe::getFromDatabase($_GET['id']);
        $administratorius = $grupe->getAdministratorius();
        $nariai = $grupe->getDarbuotojaiBeAdministratoriaus();
        $member = ($grupe->matomumas == 1);
        if (!$member) {
            if ($_SESSION['userID'] == $grupe->administratorius) {
                $member = true;
            }
        }
        if (!$member) {
            $count = count($nariai);
            for ($i = 0; $i < $count; $i++) {
                if ($nariai[$i]->id == $_SESSION['userID']) {
                    $member = true;
                    break;
                }
            }
        }
        if (!$member) {
            header("Location:accessDenied.php");
        } else {
            echo("Grupės administratorius:</br>");
            echo("<table>");
            echo("<tr><th>Vardas</th><th>Kontaktai</th><th>Profilis</th></tr>");
            echo("<tr><td>" . $administratorius->pavarde . " " . $administratorius->vardas . "</td><td><a href=\"\" onClick=\"popup('kontaktai.php?id=" . $administratorius->id . "')\">Rodyti</a></td><td><a href=\"\" onClick=\"popup('profilis.php?id=" . $administratorius->id . "')\">Rodyti</a></td></tr>");
            echo("</table>");
            $count = count($nariai);
            if ($count > 0) {
                echo("Grupės nariai:");
                echo("<table>");
                echo("<tr><th>Vardas</th><th>Kontaktai</th><th>Profilis</th></tr>");
                for ($i = 0; $i < $count; $i++) {
                    echo("<tr><td>" . $nariai[$i]->pavarde . " " . $nariai[$i]->vardas . "</td><td><a href=\"\" onClick=\"popup('kontaktai.php?id=" . $nariai[$i]->id . "')\">Rodyti</a></td><td><a href=\"\" onClick=\"popup('profilis.php?id=" . $nariai[$i]->id . "')\">Rodyti</a>" . (($_SESSION['userID'] == $administratorius->id) ? "<td><a href=\"grupeAtimtiNari.php?grupe=" . $grupe->id . "&id=" . $nariai[$i]->id . "\" onclick=\"return confirm('Ar tikrai norite pašalinti šį narį?')\">Pašalinti</a></td>" : "") . "</tr>");
                }
                echo("</table></br>");
            } else {
                echo("Narių nėra!</br>");
            }
            if ($administratorius->id == $_SESSION['userID']) {
                echo("<a href=\"grupePridetiNari.php?id=" . $grupe->id . "\">Pridėti naują</a></br>");
            }
        }
        ?>
        <a href="grupesView.php">Atgal</a>

        <script type="text/javascript">
            function popup(url) {
                newwindow = window.open(url, 'name', 'height=500,width=800,toolbar=no,status=no,menu=no,scrollbars=no,resizable=no');
                if (window.focus) {
                    newwindow.focus();
                }
                return false;
            }
        </script>