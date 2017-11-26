<?php

$grupes = grupe::getViesosGrupes();
if ($grupes != NULL) {
    echo("<table>");
    echo("<tr><th>Pavadinimas</th><th>Sukūrimo data</th><th></th></tr>");
    $count = count($grupes);
    for ($i = 0; $i < $count; $i++) {
        if ($grupes[$i]->administratorius != $_SESSION['userID']) {
            echo("<tr><td>" . $grupes[$i]->pavadinimas . "</td><td>" . $grupes[$i]->sukurimo_data . "</td><td><a href=\"grupesNariai.php?id=" . $grupes[$i]->id . "\">Grupės nariai</a></td></tr>");
        }
    }
    echo("</table></br>");
} else {
    echo ($darbuotojas->pavarde . " " . $darbuotojas->vardas . " neadministruoja jokių grupių.</br>");
}
