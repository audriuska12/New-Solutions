<?php
if(isset($_POST['prekesid'])){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("UPDATE uzsakymo_busena SET ar_atlikta=?, uzsakymo_pabaigos_data =?, uzsakymo_pabaigos_laikas=? WHERE fk_preke=?");
        $true = 1;
        $sql->bind_param('issi', $true, date("Y-m-d"), date("h:i:sa"),  $_POST['prekesid']);
        $sql->execute();
        if (mysqli_affected_rows($dbc) > 0) {
        echo ("<font size=\"5\" face='Arial'>Būsena pakeista prideta!</font>
<a href=\"inventorius.php\">Grįžti</a>");
    } else {
        echo ("<font size=\"5\" face='Arial'>Įvyko klaida </font>
<a href=\"inventorius.php\">Grįžti</a>");
    }
    }
    else{
        echo("Įvyko klaida");
    }
?>    