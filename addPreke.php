<?php

if (isset($_POST['pavadinimas'], $_POST['kaina'], $_POST['kiekis'], $_POST['gavimo_data'], $_POST['galiojimo_data'],  $_POST['garantija'], $_POST['duztanti'], $_POST['select4'], $_POST['select2'], $_POST['select1'])) {

    $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
    $sql = $dbc->prepare("INSERT INTO preke (pavadinimas, kaina, kiekis, gavimo_data, galiojimo_data, garantija, duztanti, fk_pridejimas_Id, fk_prekes_kategorija, fk_uzsakymas) VALUES (  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param('siissiiiii', $_POST['pavadinimas'], $_POST['kaina'], $_POST['kiekis'], $_POST['gavimo_data'], $_POST['galiojimo_data'], $_POST['garantija'], $_POST['duztanti'], $_POST['select4'], $_POST['select2'], $_POST['select1']);
    $sql->execute();
    if (mysqli_affected_rows($dbc) > 0) {
        echo ("<font size=\"5\" face='Arial'>Prekė sėkmingai prideta :) !</font>
<a href=\"inventorius.php\">Grįžti</a>");
    } else {
        echo ("<font size=\"5\" face='Arial'>Prekė nebuvo pridėta :( </font>
<a href=\"inventorius.php\">Grįžti</a>");
    }
}
?>    

