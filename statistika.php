<!DOCTYPE html>
<html>
    <head>
  <link rel="stylesheet" href="tables.css">
</head>
<body>

<?php


include "prekes_zymejimas.php";
include "turizymejima.php";
include "preke.php";
$userID = 10;
// Create connection
$conn = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT pavadinimas, pardavimo_data, kaina, kiekis, id FROM preke";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo("<table>");
    echo '<tr> <th> <font size="5"'." face='Arial'>" . "Neparduotos prekės:" . '</font> <th></th><th></th></th> </tr>';
    echo("<tr> <th>Pavadinimas </th> <th>Kaina </th> <th>Kiekis</th>");
    
    while($row = $result->fetch_assoc()) {
        if(is_null($row["pardavimo_data"])){
        $url_id = $row['id'];
        echo "<tr><td>" . $row["pavadinimas"] . "</td><td>" . $row["kaina"]. "</td><td>".  $row["kiekis"] . "</td>" ;
        
    } else {}
    }
    echo("<tr><td>
        </form>" ."<form method=\"POST\" action=\"inventorius.php\">".
        "<input type=\"submit\" name=\"submit\" value=\"Atgal į inventorių\" />"
        ."</td><td></td><td></td></tr></table>" );
    
    
} else {
    echo "0 results";
}



$conn->close();
?> 

</body>
</html>