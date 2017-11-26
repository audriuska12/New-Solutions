<?php
if(isset($_POST['kiekis'], $_POST['prekesid'])){
        $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
        
        $abc = "SELECT kiekis FROM preke WHERE id=".$_POST['prekesid'].";";
        $prekeskiekis = $dbc->query($abc);
       while( $row = $prekeskiekis->fetch_assoc()) {
        $prekeskiekioskaicius = $row['kiekis'];
       }
       if($prekeskiekioskaicius > $_POST['kiekis']){
           $sql1 = $dbc->prepare("UPDATE preke SET pardavimo_data=? WHERE id=?");
            $sql1->bind_param('ii', date("Y-m-d"), $_POST['prekesid']);
            $sql1->execute();
       }
        $sql = $dbc->prepare("UPDATE preke SET kiekis=? WHERE id=?");
        $sql->bind_param('ii', $_POST['kiekis'], $_POST['prekesid']);
        $sql->execute();
        echo("<font size=\"5\" face='Arial'> Prekių kiekis sėkmingai pakeistas!</font>");
        echo("</form>" . "<br>"."<form method=\"POST\" action=\"inventorius.php\">".
        "<input type=\"submit\" name=\"submit\" value=\"Atgal į inventorių\" />");
}
?>

