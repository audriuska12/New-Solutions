<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="tables.css">
        <title>Darbuotojų sąrašas</title>
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
        include "zinute.php";
        $message = zinute::getFromDatabase($_GET['id']);
        echo("<table>");
        if ($_GET['src'] == "inbox.php") {
            $sender = darbuotojas::getFromDatabase($message->siuntejas);
            echo("<tr><th>Siuntėjas:</th><td>" . $sender->pavarde . " " . $sender->vardas . "</td></tr>");
        } else if ($_GET['src'] == "outbox.php"){
            $recipient = darbuotojas::getFromDatabase($message->gavejas);
            echo("<tr><th>Siuntėjas:</th><td>" . $recipient->pavarde . " " . $recipient->vardas . "</td></tr>");
        }
        echo("<tr><th>Tekstas:</th><td>" . $message->tekstas . "</tr>");
        echo("</table>");
        echo("<td><a href=\"trintiZinute.php?id=" . $message->id . "&src=".$_GET['src']."\" onclick=\"return confirm('Ar tikrai norite ištrinti šią žinutę?')\">Ištrintii</a></td>");
        echo("<a href=\"" . $_GET['src'] . "\">Atgal");
        ?>
    </body>
</html>