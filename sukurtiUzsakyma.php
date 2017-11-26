<!DOCTYPE html>
<html>
    <head>
  <link rel="stylesheet" href="tables.css">
</head>
<body>
<?php

if (isset($_POST['userid'])) {
    $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
    $sql = $dbc->prepare("INSERT INTO uzsakymas (sudarymo_data, sudarymo_laikas, fk_darbuotojas) VALUES (?, ?, ?)");
    $sql->bind_param('ssi', date("Y-m-d"), date("h:i:sa"), $_POST['userid']);
    $sql->execute();
    if (mysqli_affected_rows($dbc) > 0) {
        
        $abc = "SELECT id FROM uzsakymas ORDER BY sudarymo_data DESC LIMIT 1";
        $uzsakymas = $dbc->query($abc);
       while( $row = $uzsakymas->fetch_assoc()) {
        $uzsakymoid = $row['id'];
      } 
    $ar_atlikta=0;
    
    echo ("<table align=center>");
    echo '<tr> <th> <font size="5"' . " face='Arial'>" . "Įveskite užsakymo duomenis:" . '</font> </th></tr>';

    echo ("<td>" .
    " <form method=\"POST\" action=\"addUzsakymas.php\">
        
       <tr><td> Pasirinkite prekę:");
        $sql3 = "SELECT id, pavadinimas FROM preke";
        $result = $dbc->query($sql3);
        if ($result->num_rows > 0) {
            $select = '<select name="preke">';
            while ($rs = mysqli_fetch_array($result)) {
                $select .= '<option value="' . $rs['id'] . '">' . $rs['pavadinimas'] . '</option>';
            }
            $select .= '</select>';
        echo $select;};
        echo("</tr></td>");
        echo("
            
        <tr><td>Kiekis: <input type=\"number\" name=\"kiekis\" style=\"width:20%;\" required></td></tr>
        <tr><td>Numatoma užsakymo pabaiga:<input type=\"date\" name=\"uzsakymopab_data\"  required></td></tr>
        <input type=\"hidden\" name=\"uzsakymoid\" value=\"".$uzsakymoid."\">
        <input type=\"hidden\" name=\"ar_atlikta\" value=\"".$ar_atlikta."\">
        <tr><td><input type=\"submit\" name=\"submit\" value=\"Pridėti\" /></td></tr>
        </select> 
         </form>
         <br></br>");
       
    } else { }
    
        
        echo("<tr><td>
        </form>" ."<form method=\"POST\" action=\"inventorius.php\">".
        "<input type=\"submit\" name=\"submit\" value=\"Atgal į inventorių\" />"
        ."</td></tr></table>" );
    
}
?>
    </body>
</html>
