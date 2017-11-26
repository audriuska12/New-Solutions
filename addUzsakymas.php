<?php

if (isset($_POST['preke'], $_POST['kiekis'], $_POST['uzsakymopab_data'], $_POST['uzsakymoid'], $_POST['ar_atlikta'])) {
    $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
    $sql = $dbc->prepare("INSERT INTO uzsakymo_busena (kiekis, ar_atlikta, numatoma_uzsakymo_pabaiga, fk_preke, fk_uzsakymas) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param('iisii', $_POST['kiekis'], $_POST['ar_atlikta'], $_POST['uzsakymopab_data'],  $_POST['preke'], $_POST['uzsakymoid']);
    $sql->execute();
    if (mysqli_affected_rows($dbc) > 0) {
        echo ("<font size=\"5\" face='Arial'>Užsakymas sėkmingai pridėtas!</font>
<a href=\"inventorius.php\">Grįžti</a>");
    } else {
        echo ("<font size=\"5\" face='Arial'>Užsakymo pridėti nepavyko </font>
<a href=\"inventorius.php\">Grįžti</a>");
    }
}
    
?>

