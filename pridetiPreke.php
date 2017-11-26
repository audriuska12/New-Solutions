
<html>
    <head>
  <link rel="stylesheet" href="tables.css">
</head>
<body>

<?php

$dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
echo ("<table align=center>");
echo '<tr> <th> <font size="5"' . " face='Arial'>" . "Įveskite naujos prekės duomenis:" . '</font> </th></tr>';
$nulis = 0;
echo (
 " <form method=\"POST\" action=\"addPreke.php\">
        
        <tr><td>Pavadinimas: <input type=\"text\" name=\"pavadinimas\" style=\"width:20%;\" required></td></tr>
        <tr><td>Kaina: <input type=\"number\" name=\"kaina\" style=\"width:20%;\" required></td></tr>
        <input type=\"hidden\" name=\"kiekis\" value=\"".$nulis."\">
        <tr><td>Numatoma gavimo data:<input type=\"date\" name=\"gavimo_data\" style=\"width:20%;\" required></td></tr>
        <tr><td>Galiojimo data:<input type=\"date\" name=\"galiojimo_data\" style=\"width:20%;\" required></td></tr>
        <tr><td>Garantija: <input type=\"number\" name=\"garantija\" style=\"width:20%;\" required></td></tr>
        <tr><td>Ar prekė dūžtanti?: <select name=\"duztanti\">
        <option value=\"1\">Taip</option>
        <option value=\"0\">Ne</option>
        </select> </td></tr>
        
        <tr><td>Prekes uzsakymo id: ");
$sql3 = "SELECT id FROM uzsakymas";
$result3 = $dbc->query($sql3);
if ($result3->num_rows > 0) {
    $select3 = '<select name="select1">';
    while ($rs3 = mysqli_fetch_array($result3)) {
        $select3 .= '<option value="' . $rs3['id'] . '">' . $rs3['id'] . '</option>';
    }
    $select3 .= '</select>';
    echo $select3;
}
echo("</td></tr>");

echo("<tr><td> Prekes kategorija: ");
$sql4 = "SELECT id, pavadinimas FROM prekes_kategorija";
$result4 = $dbc->query($sql4);
if ($result4->num_rows > 0) {
    $select4 = '<select name="select2">';
    while ($rs4 = mysqli_fetch_array($result4)) {
        $select4 .= '<option value="' . $rs4['id'] . '">' . $rs4['pavadinimas'] . '</option>';
    }
}
$select4 .= '</select>';
echo $select4;
echo("</td></tr>");

echo ("<tr><td> Prekes apskaita: ");

$sql2 = "SELECT id FROM prekiu_apskaita";
$result2 = $dbc->query($sql2);
if ($result2->num_rows > 0) {
    $select2 = '<select name="select3">';
    while ($rs2 = mysqli_fetch_array($result2)) {
        $select2 .= '<option value="' . $rs2['id'] . '">' . $rs2['id'] . '</option>';
    }
}
$select2 .= '</select>';
echo $select2;echo("</td></tr>");

echo ("<tr><td>Pridejimo priezastis: ");
$sql1 = "SELECT id, pavadinimas FROM pridejimas";
$result1 = $dbc->query($sql1);
if ($result1->num_rows > 0) {
    $select1 = '<select name="select4">';
    while ($rs1 = mysqli_fetch_array($result1)) {
        $select1 .= '<option value="' . $rs1['id'] . '">' . $rs1['pavadinimas'] . '</option>';
    }
}
$select1 .= '</select>';
echo $select1;echo("</td></tr>");

echo("<tr><td><input type=\"submit\" name=\"submit\" value=\"Pridėti\" />
        </form>" . "<br><br>"."<form method=\"POST\" action=\"inventorius.php\">".
        "<input type=\"submit\" name=\"submit\" value=\"Atgal į inventorių\" />"
        ."</td></tr></table>" );

?>
</body>
</html>
