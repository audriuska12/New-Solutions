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
        $kontaktai = darbuotojas::getKontaktai($_GET['id']);
        echo ("<table>");
        echo("<tr><th>Telefono numeris:</th><td>" . $kontaktai['tel_nr'] . "</td></tr>");
        echo("<tr><th>El. paštas:</th><td>" . $kontaktai['el_pastas'] . "</td></tr>");
        echo("<tr><th>Adresas:</th><td>" . $kontaktai['adresas'] . "</td></tr>");
        echo ("</table></br>");
        if($_SESSION['userID'] == $_GET['id']){
            echo ("<a href=\"kontaktaiRedaguoti.php\">Redaguoti</a>");
        }
        ?>
    </body>
</html>