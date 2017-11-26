<?php
if (isset($_POST['prekesid']) ){
    $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        $sql = $dbc->prepare("DELETE FROM turizymejima WHERE fk_preke = ?");
        $sql->bind_param('i', $_POST['prekesid']);
        $sql->execute();
        if (mysqli_affected_rows($dbc) > 0) {
        echo ("<font size=\"5\" face='Arial'>Žymėjimas sėkmingai ištrintas :) !</font>
<a href=\"inventorius.php\">Grįžti</a>");
    } else {
        echo ("<font size=\"5\" face='Arial'>Žymėjimo nepavyko ištrinti :( </font>
<a href=\"inventorius.php\">Grįžti</a>");
    }
    }


