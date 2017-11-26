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
$rusis = $user->getRusis()->pavadinimas;
$darbuotojaiSamdyti = darbuotojas::getPasamdyti();
$countSamdyti = count($darbuotojaiSamdyti);
if ($countSamdyti > 0) {
    echo "Pasamdyti darbuotojai:";
    echo("<table>");
    echo("<tr><th>Vardas</th><th>Pavardė</th><th>Profilis</th><th>Dirba nuo</th><th>Alga</th><th>Pozicija</th>".(($rusis == "Parduotuvės vadovas" ||$rusis=="Parduotuvių tinklo vadovas")? ("<th>Pareigos</th>"): "")."<th>Grafikas</th>".(($rusis == "Parduotuvės vadovas" ||$rusis=="Parduotuvių tinklo vadovas")? ("<th>Pastabos</th>"): "")."".(($rusis == "Parduotuvės vadovas" ||$rusis=="Parduotuvių tinklo vadovas")? ("<th></th>"): "")."</tr>");
    for ($i = 0; $i < $countSamdyti; $i++) {
        echo("<tr><td>" . $darbuotojaiSamdyti[$i]->vardas . "</td><td>" . $darbuotojaiSamdyti[$i]->pavarde . "</td><td><a href=\"profilis.php?id=" . $darbuotojaiSamdyti[$i]->id . "\">Rodyti</a></td><td>" . $darbuotojaiSamdyti[$i]->dirba_nuo . "</td><td>" . $darbuotojaiSamdyti[$i]->alga . "</td><td>" . $darbuotojaiSamdyti[$i]->getRusis()->pavadinimas . "</td>".(($rusis == "Parduotuvės vadovas" ||$rusis=="Parduotuvių tinklo vadovas")? ("<td><a href=\"\" onClick=\"popup('pareigosRodyti.php?id=" . $darbuotojaiSamdyti[$i]->id . "')\">Rodyti</a></td>"): "")."<td><a href=\"\" onClick=\"popup('grafikasView.php?id=" . $darbuotojaiSamdyti[$i]->id . "')\">Rodyti</a></td>".(($rusis == "Parduotuvės vadovas" ||$rusis=="Parduotuvių tinklo vadovas")? ("<td><a href=\"\" onClick=\"popup('pastabosViesos.php?id=" . $darbuotojaiSamdyti[$i]->id . "')\">Rodyti</a></td>"): "").($darbuotojaiSamdyti[$i]->id != $user->id &&($rusis == "Parduotuvės vadovas" ||$rusis=="Parduotuvių tinklo vadovas")? ("<td><a href=\"atleistiDarbuotoja.php?id=" . $darbuotojaiSamdyti[$i]->id . "\" onclick=\"return confirm('Ar tikrai norite atleisti šį darbuotoją?')\">Atleisti</a></td>"): "")."</tr>");
    }
    echo("<table>");
} else {
    echo "Firmoje nėra pasamdytų darbuotojų!</br>";
}
$darbuotojaiAtleisti = darbuotojas::getAtleisti();
;
$countAtleisti = count($darbuotojaiAtleisti);
if ($countAtleisti > 0) {
    echo "Atleisti darbuotojai:";
    echo("<table>");
    echo("<tr><th>Vardas</th><th>Pavardė</th><th>Profilis</th><th>Dirba nuo</th><th>Alga</th><th>Pozicija</th><th></th></tr>");
    for ($i = 0; $i < $countAtleisti; $i++) {
        echo("<tr><td>" . $darbuotojaiAtleisti[$i]->vardas . "</td><td>" . $darbuotojaiAtleisti[$i]->pavarde . "</td><td><a href=\"profilis.php?id=" . $darbuotojaiAtleisti[$i]->id . "\">Rodyti</a></td><td>" . $darbuotojaiAtleisti[$i]->dirba_nuo . "</td><td>" . $darbuotojaiAtleisti[$i]->alga . "</td><td>" . $darbuotojaiAtleisti[$i]->getRusis()->pavadinimas . "</td><td><a href=\"atsamdytiDarbuotoja.php?id=" . $darbuotojaiAtleisti[$i]->id . "\" onclick=\"return confirm('Ar tikrai norite atsamdyti šį darbuotoją?')\">Atsamdyti</a></td></tr>");
    }
    echo("<table>");
} else {
    echo "Firmoje nėra atleistų darbuotojų.</br>";
}
?>
<a href="registracija.php">Registruoti naują</a>
<script type="text/javascript">
    function popup(url) {
        newwindow = window.open(url, 'name', 'height=500,width=800,toolbar=no,status=no,menu=no,scrollbars=no,resizable=no');
        if (window.focus) {
            newwindow.focus();
        }
        return false;
    }
</script>
    </body>
</html>