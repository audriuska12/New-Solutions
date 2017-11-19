<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "darbuotojas.php";
$darbuotojai = darbuotojas::getPasamdyti() + darbuotojas::getAtleisti();
$count = count($darbuotojai);
if ($count > 0) {
    echo("<table>");
    echo("<tr><th>Vardas</th><th>Pavardė</th><th>Kontaktai</th><th>Dirba nuo</th><th>Alga</th><th>Pozicija</th></tr>");
    for ($i = 0; $i < $count; $i++) {
        echo("<tr><td>" . $darbuotojai[$i]->vardas . "</td><td>" . $darbuotojai[$i]->pavarde . "</td><td><a href=\"\" onClick=\"popup('kontaktai.php?id=" . $darbuotojai[$i]->id . "')\">Rodyti</a></td><td>" . $darbuotojai[$i]->dirba_nuo . "</td><td>" . $darbuotojai[$i]->alga . "</td><td>" . $darbuotojai[$i]->getRusis()->pavadinimas . "</td></tr>");
    }
    echo("<table>");
} else {
    echo "Firmoje nėra darbuotojų!";
}
?>
<script type="text/javascript">
    function popup(url) {
        newwindow = window.open(url, 'name', 'height=100,width=325,toolbar=no,status=no,menu=no,scrollbars=no,resizable=no');
        if (window.focus) {
            newwindow.focus()
        }
        return false;
    }
</script>