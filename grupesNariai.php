<?php
    include "grupe.php";
    $grupe=grupe::getFromDatabase($_GET['id']);
    $administratorius=$grupe->getAdministratorius();
    $nariai = $grupe->getDarbuotojaiBeAdministratoriaus();
    echo("Grupės administratorius:</br>");
    echo("<table>");
    echo("<tr><th>Vardas</th><th>Kontaktai</th><th>Profilis</th></tr>");
    echo("<tr><td>".$administratorius->pavarde." ".$administratorius->vardas."</td><td><a href=\"\" onClick=\"popup('kontaktai.php?id=" . $administratorius->id . "')\">Rodyti</a></td><td><a href=\"\" onClick=\"popup('profilis.php?id=" . $administratorius->id . "')\">Rodyti</a></td></tr>");
    echo("</table>");
    $count=count($nariai);
    if($count>0){
        echo("Grupės nariai:");
        echo("<table>");
        echo("<tr><th>Vardas</th><th>Kontaktai</th><th>Profilis</th></tr>");
        for($i=0; $i<$count; $i++){
            echo("<tr><td>".$nariai[$i]->pavarde." ".$nariai[$i]->vardas."</td><td><a href=\"\" onClick=\"popup('kontaktai.php?id=" . $nariai[$i]->id . "')\">Rodyti</a></td><td><a href=\"\" onClick=\"popup('profilis.php?id=" . $nariai[$i]->id . "')\">Rodyti</a><td><a href=\"grupeAtimtiNari.php?grupe=".$grupe->id."&id=" . $nariai[$i]->id . "\" onclick=\"return confirm('Ar tikrai norite atleisti šį darbuotoją?')\">Pašalinti</a></td></tr>");
        }
        echo("</table></br>");
    } else{
        echo("Narių nėra!</br>");
    }
    echo("<a href=\"grupePridetiNari.php?id=".$grupe->id."\">Pridėti naują</a>");
?>


<script type="text/javascript">
    function popup(url) {
        newwindow = window.open(url, 'name', 'height=400,width=800,toolbar=no,status=no,menu=no,scrollbars=no,resizable=no');
        if (window.focus) {
            newwindow.focus();
        }
        return false;
    }
</script>