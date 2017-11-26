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
        } else {
            $user = darbuotojas::getFromDatabase($_SESSION['userID']);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $user->updateKontaktai($_POST['tel_nr'], $_POST['el_pastas'], $_POST['adresas']);
                echo "<script>window.onunload = refreshParent;function refreshParent(){window.opener.location.reload();}</script>";
                echo "<script>window.close();</script>";
            } else {
                $kontaktai = $user->getKontaktai($_SESSION['userID']);
                echo("<form action=\"kontaktaiRedaguoti.php\" method=\"POST\">");
                echo("<table>");
                echo("<tr><th>Telefono numeris:</th><td><input name=\"tel_nr\" type=\"text\" value=\"" . $kontaktai['tel_nr'] . "\"></input></td></tr>");
                echo("<tr><th>El. paštas:</th><td><input name=\"el_pastas\" type=\"text\" value=\"" . $kontaktai['el_pastas'] . "\"></input></td></tr>");
                echo("<tr><th>Adresas:</th><td><input name=\"adresas\" type=\"text\" value=\"" . $kontaktai['adresas'] . "\"></input></td></tr>");
                echo("</table>");
                echo("<input type=\"submit\" value=\"Išsaugoti\"></input>");
                echo("</form>");
            }
        }
        ?>
    </body>
</hml>

