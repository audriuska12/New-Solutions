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
        include"linksDarbuotojai.php";
        include "darbuotojas.php";
        if (!isset($_SESSION['userID'])) {
            header("Location:accessDenied.php");
        }
        $darbuotojas = darbuotojas::getFromDatabase($_SESSION['userID']);
        echo("Administruojamos grupės:</br>");
        include "grupesAdministruojamos.php";
        echo("Viešos grupės:</br>");
        include "grupesViesos.php";
        ?>
    </body>
</html>

