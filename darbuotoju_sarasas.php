<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "darbuotojas.php";
$darbuotojaiSamdyti = darbuotojas::getPasamdyti();
$countSamdyti = count($darbuotojaiSamdyti);
if ($countSamdyti > 0) {
    echo "Pasamdyti darbuotojai:";
    echo("<table>");
    echo("<tr><th>Vardas</th><th>Pavardė</th><th>Kontaktai</th><th>Dirba nuo</th><th>Alga</th><th>Pozicija</th></tr>");
    for ($i = 0; $i < $countSamdyti; $i++) {
        echo("<tr><td>" . $darbuotojaiSamdyti[$i]->vardas . "</td><td>" . $darbuotojaiSamdyti[$i]->pavarde . "</td><td><a href=\"\" onClick=\"popup('kontaktai.php?id=" . $darbuotojaiSamdyti[$i]->id . "')\">Rodyti</a></td><td>" . $darbuotojaiSamdyti[$i]->dirba_nuo . "</td><td>" . $darbuotojaiSamdyti[$i]->alga . "</td><td>" . $darbuotojaiSamdyti[$i]->getRusis()->pavadinimas . "</td><td><a href=\"\" onClick=\"atleistiConfirm('alteistiDarbuotoja.php?id=" . $darbuotojaiSamdyti[$i]->id . "')\">Atleisti</a></td></tr>");
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
    echo("<tr><th>Vardas</th><th>Pavardė</th><th>Kontaktai</th><th>Dirba nuo</th><th>Alga</th><th>Pozicija</th></tr>");
    for ($i = 0; $i < $count; $i++) {
        echo("<tr><td>" . $darbuotojaiAtleisti[$i]->vardas . "</td><td>" . $darbuotojaiAtleisti[$i]->pavarde . "</td><td><a href=\"\" onClick=\"popup('kontaktai.php?id=" . $darbuotojaiAtleisti[$i]->id . "')\">Rodyti</a></td><td>" . $darbuotojaiAtleisti[$i]->dirba_nuo . "</td><td>" . $darbuotojaiAtleisti[$i]->alga . "</td><td>" . $darbuotojaiAtleisti[$i]->getRusis()->pavadinimas . "</td><td><a href=\"\" onClick=\"atsamdytiConfirm('atsamdytiDarbuotoja.php?id=" . $darbuotojaiAtleisti[$i]->id . "')\">Atsamdyti</a></td></tr>");
    }
    echo("<table>");
} else {
    echo "Firmoje nėra atleistų darbuotojų.</br>";
}
?>
<a href="registracija.php">Registruoti naują</a>
<script type="text/javascript">
    function popup(url) {
        newwindow = window.open(url, 'name', 'height=100,width=325,toolbar=no,status=no,menu=no,scrollbars=no,resizable=no');
        if (window.focus) {
            newwindow.focus()
        }
        return false;
    }

    function atleistiConfirm(url) {
        if (confirm("Ar tikrai norite atleisti šį darbuotoją?")) {
            window.location.replace(url);
        } else
            return false;
    }
    function atsamdytiConfirm(url) {
        if (confirm("Ar tikrai norite atsamdyti šį darbuotoją?")) {
            window.location.replace(url);
        } else
            return false;
    }
</script>