<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "darbuotojas.php";
$user = darbuotojas::getFromDatabase($_GET['id']);
echo($user->pavarde." ". $user->vardas." profilis:");
echo ("<table>");
echo("<tr><th>Vardas:</th><td>$user->vardas</td></tr>");
echo("<tr><th>Pavardė:</th><td>$user->pavarde</td></tr>");
echo("<tr><th>Telefono numeris:</th><td>$user->tel_nr</td></tr>");
echo("<tr><th>El. paštas:</th><td>$user->el_pastas</td></tr>");
echo("<tr><th>Adresas:</th><td>$user->adresas</td></tr>");
echo("<tr><th>Dirbate nuo:</th><td>$user->dirba_nuo</td></tr>");
echo("<tr><th>Gaunama alga:</th><td>$user->alga</td></tr>");
echo("<tr><th>Pozicija:</th><td>" . $user->getRusis()->pavadinimas . "</td></tr>");
echo("</table>");
?>

