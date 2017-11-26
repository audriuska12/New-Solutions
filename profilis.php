<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="tables.css">
        <title>Profilis</title>
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
        include "linksDarbuotojai.php";
        $user = darbuotojas::getFromDatabase($_SESSION['userID']);
        if (isset($_GET['id'])) {
            $darbuotojas = darbuotojas::getFromDatabase($_GET['id']);
        } else {
            $darbuotojas = $user;
        }
        echo($darbuotojas->pavarde . " " . $darbuotojas->vardas . " profilis:");
        echo ("<table>");
        echo("<tr><th>Vardas:</th><td>$darbuotojas->vardas</td></tr>");
        echo("<tr><th>Pavardė:</th><td>$darbuotojas->pavarde</td></tr>");
        echo("<tr><th>Telefono numeris:</th><td>$darbuotojas->tel_nr</td></tr>");
        echo("<tr><th>El. paštas:</th><td>$darbuotojas->el_pastas</td></tr>");
        echo("<tr><th>Adresas:</th><td>$darbuotojas->adresas</td></tr>");
        echo("<tr><th>Dirba nuo:</th><td>$darbuotojas->dirba_nuo</td></tr>");
        echo("<tr><th>Gaunama alga:</th><td>$darbuotojas->alga</td></tr>");
        echo("<tr><th>Pozicija:</th><td>" . $darbuotojas->getRusis()->pavadinimas . "</td></tr>");
        echo("</table></br>");
        if (!isset($_GET['id']) || $_GET['id'] == $_SESSION['userID']) {
            echo ("<a href=\"\" onClick=\"popup('kontaktaiRedaguoti.php')\">Redaguoti kontaktus</a></br>");
            echo ("<a href=\"\" onClick=\"popup('grafikasView.php?id=" . $_SESSION['userID'] . "')\"\">Grafikas<a></br>");
            echo ("<a href=\"\" onClick=\"popup('pareigosRodyti.php?id=" . $_SESSION['userID'] . "')\"\">Pareigos<a></br>");
        }
        if ($user->arVirsesnis($darbuotojas) || ($user->id == $darbuotojas->id && $user->getRusis()->pavadinimas == "Parduotuvių tinklo vadovas")) {
        echo ("<a href=\"\" onClick=\"popup('profilisEdit.php?id=" . ((isset($_GET['id'])? $_GET['id']:$_SESSION['userID'] )). "')\"\">Redaguoti profilį<a></br>");
        }
        ?>
        <script type="text/javascript">
            function popup(url) {
                newwindow = window.open(url, 'name', 'height=400,width=800,toolbar=no,status=no,menu=no,scrollbars=no,resizable=no');
                if (window.focus) {
                    newwindow.focus();
                }
                return false;
            }
        </script>
    </body>
</html>
