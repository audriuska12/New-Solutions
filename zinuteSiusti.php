<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="tables.css">
        <title>Žinutės siuntimas</title>
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $recipients = explode(",", $_POST['recipients']);
            var_dump($recipients);
            include "zinute.php";
            zinute::issiustiZinute($_SESSION['userID'], $recipients, $_POST['text']);
            header("Location: outbox.php");
        }
        ?>
        <form action="zinuteSiusti.php" method="post">
            <table>
                <tr><th>Gavėjas:</th><td><select name="recipients" style="width: 500px">
                            <?php
                            $darbuotojai = darbuotojas::getPasamdyti();
                            $count = count($darbuotojai);
                            for ($i = 0; $i < $count; $i++) {
                                if ($darbuotojai[$i]->id != $_SESSION['userID']) {
                                    echo ("<option value=\"" . $darbuotojai[$i]->id . "\">" . $darbuotojai[$i]->pavarde . " " . $darbuotojai[$i]->vardas . "</option>");
                                }
                            }
                            $grupes = $user->getMatomosGrupes();
                            $countg=count($grupes);
                            for($i=0; $i< $countg; $i++){
                                $nariai = $grupes[$i]->getDarbuotojai();
                                $countn = count($nariai);
                                echo ("<option value=\"");
                                for($j = 0; $j < $countn; $j++){
                                    if($j != 0){ echo ",";}
                                    echo $nariai[$j]->id;
                                }
                                echo ("\">" . $grupes[$i]->pavadinimas. "</option>");
                            }
                            ?>
                        </select></td></tr>
                <tr><th>Žinutės tekstas:</th><td><textarea class="scrollabletextbox" name="text" style="height: 400px; width: 500px"></textarea></td></tr>
            </table>
            <input type="submit" value="Siųsti"></input>
        </form></body></html>