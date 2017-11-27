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
        $zinutes = zinute::gautiGautasZinutes($_SESSION['userID']);
        echo("<table>");
        echo("<tr><th>Siuntėjas</th><th></th></tr>");
        $count = count($zinutes);
        for($i=0; $i<$count; $i++){
            echo("<tr><td>".$zinutes[$i]->vardas." ".$zinutes[$i]->pavarde."</td><td><a href=zinuteSkaityti.php?id=\"".$zinutes[$i]->id."&src=inbox.php\">Skaityti</a></td></tr>");
           // echo("<tr><td>".$zinutes[$i]->fk_siuntejas." ".$zinutes[$i]->fk_siuntejas."</td><td><a href=zinuteSkaityti.php?id=\"".$zinutes[$i]->id."&src=inbox.php\">Skaityti</a></td></tr>");
        }
        echo("</table>");
        ?>
    </body></html>