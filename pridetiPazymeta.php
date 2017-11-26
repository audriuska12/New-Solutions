<?php
if (isset($_POST['prekesid'], $_POST['select3'])) {
    $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
    $sql = $dbc->prepare("INSERT INTO turizymejima (fk_preke, fk_prekes_zymejimas) VALUES (?, ?)");
    $sql->bind_param('ii', $_POST['prekesid'], $_POST['select3']);
    $sql->execute();
    if (mysqli_affected_rows($dbc) > 0) {
        echo ("<font size=\"5\" face='Arial'>Žymėjimas sėkmingai pridėtas :) !</font>
<a href=\"inventorius.php\">Grįžti</a>");
    } else {
        echo ("<font size=\"5\" face='Arial'>Žymėjimas nebuvo pridėtas :( </font>
<a href=\"inventorius.php\">Grįžti</a>");
    }
}