<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="tables.css">
        <title>Gautos žinutės</title>
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
        $user = darbuotojas::getFromDatabase($_SESSION['userID']);
        include "linksDarbuotojai.php";
        include "zinute.php";
        echo("Gautos žinutės:</br>");
        $zinutes = zinute::gautiIssiustasZinutes($_SESSION['userID']);
        echo("<table>");
        echo("<tr><th>Gavėjas</th><th></th></tr>");
        $count = count($zinutes);
        for($i=0; $i<$count; $i++){
            echo("<tr><td>".$zinutes[$i]->gavejas->pavarde." ".$zinutes[$i]->gavejas->vardas."</td><td><a href=zinuteSkaityti.php?id=\"".$zinutes[$i]->id."&src=outbox.php\">Skaityti</a></td></tr>");
        }
        echo("</table></br>");
        ?>
        <a href="zinuteSiusti.php">Siųsti naują</a>
    </body></html>