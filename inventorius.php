<!DOCTYPE html>
<html>
    <head>
  <link rel="stylesheet" href="tables.css">
</head>
<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "darbuotojas.php";
if (!isset($_SESSION['userID'])) {
    header("Location:accessDenied.php");
}
include "linksDarbuotojai.php";
$user = darbuotojas::getFromDatabase($_SESSION['userID']);
$userIDD=$user->id;
$userRUSIS = $user->getRusis()->id;
include "prekes_zymejimas.php";
include "turizymejima.php";
include "preke.php";




//DARBUOTOJO GUI

if($userRUSIS == 1){
    
    
$conn = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT pavadinimas, kaina, kiekis, id FROM preke";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<font size="5"'." face='Arial'>" . "Parduotuvės inventorius:" . '</font>';
    echo("<table>");
    echo("<tr> <th>Pavadinimas </th> <th>Kaina </th> <th>Kiekis</th> <th> Keisti kiekį </th>");
    
    while($row = $result->fetch_assoc()) {
        $url_id = $row['id'];
        echo "<tr><td>" . $row["pavadinimas"] . "</td><td>" . $row["kaina"]. "</td><td>".  $row["kiekis"] . "</td>" ;
        echo ("<td>". 
                " <form method=\"POST\" action=\"updateQuantity.php\">
        <input type=\"number\" name=\"kiekis\" style=\"width:50%;\" required>
        <input type=\"hidden\" name=\"prekesid\" value=\"".$url_id."\">
        <input type=\"submit\" name=\"submit\" value=\"Keisti\" />
        </form>" . 
                "</td>");
       
    }
    echo ("</table>");
    echo ("<br></br>");
    echo("<table>");
    echo("<td> <form method=\"POST\" action=\"uzsakymusarasas.php\">
        <input type=\"submit\" name=\"submit\" value=\"Peržiūrėti užsakymų sąrašą\" />
        </form> </td>" );
    
} else {
    echo "0 results";}}
    

//PARDUOTUVES VADOVO GUI

    
if($userRUSIS == 2){
        
        // Create connection
$conn = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT pavadinimas, kaina, kiekis, id FROM preke";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<font size="5"'." face='Arial'>" . "Parduotuvės inventorius:" . '</font>';
    echo("<table>");
    echo("<tr> <th>Pavadinimas </th> <th>Kaina </th> <th>Kiekis</th> <th> Keisti kiekį </th> <th>Žymė</th>");
    
    while($row = $result->fetch_assoc()) {
        $url_id = $row['id'];
        echo "<tr><td>" . $row["pavadinimas"] . "</td><td>" . $row["kaina"]. "</td><td>".  $row["kiekis"] . "</td>" ;
        echo ("<td>". 
                " <form method=\"POST\" action=\"updateQuantity.php\">
        <input type=\"number\" name=\"kiekis\" style=\"width:50%;\" required>
        <input type=\"hidden\" name=\"prekesid\" value=\"".$url_id."\">
        <input type=\"submit\" name=\"submit\" value=\"Keisti\" />
        </form>" . 
                "</td>");
        
        $sql1 = $conn->prepare("SELECT * FROM turizymejima WHERE fk_preke = ?");
        $sql1->bind_param('i', $url_id);
        $sql1->execute();
        $result1 = $sql1->get_result();
        
        if (mysqli_affected_rows($conn) > 0) {
            $komentaroid = turizymejima::getFromDatabase($url_id);
            $komid = $komentaroid->fk_prekes_zymejimas;
            $komentaras = prekes_zymejimas::getFromDatabase($komid);
   echo "<td>" . $komentaras->pavadinimas . "</td>";
    } else { echo("<td></td>");}
    
  
    
        
    }
    echo ("</table>");
    echo ("<br></br>");
    echo("<table>");
    echo("<tr><td>"."<form>
        <input type=\"button\" value=\"Pridėti prekę į inventorių\" onclick=\"window.location.href='pridetiPreke.php'\" />
        </form></td>");
    echo("<td> <form method=\"POST\" action=\"sukurtiUzsakyma.php\">
        <input type=\"hidden\" name=\"userid\" value=\"".$userIDD."\">
        <input type=\"submit\" name=\"submit\" value=\"Užsakyti prekę\" />
        </form> </td>" );
    echo("<td> <form method=\"POST\" action=\"uzsakymusarasas.php\">
        <input type=\"submit\" name=\"submit\" value=\"Peržiūrėti užsakymų sąrašą\" />
        </form> </td>" );
    
    
} else {
    echo "0 results";
}
    }
    
    //Parduotuvių tinklo vadovo GUI
    if($userRUSIS == 3){
          
$conn = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT pavadinimas, kaina, kiekis, id FROM preke";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<font size="5"'." face='Arial'>" . "Parduotuvės inventorius:" . '</font>';
    echo("<table>");
    echo("<tr> <th>Pavadinimas </th> <th>Kaina </th> <th>Kiekis</th> <th> Keisti kiekį </th> <th>Žymė</th><th></th> <th>Keisti žymę</th><th>Šalinti žymę</th>");
    
    while($row = $result->fetch_assoc()) {
        $url_id = $row['id'];
        echo "<tr><td>" . $row["pavadinimas"] . "</td><td>" . $row["kaina"]. "</td><td>".  $row["kiekis"] . "</td>" ;
        echo ("<td>". 
                " <form method=\"POST\" action=\"updateQuantity.php\">
        <input type=\"number\" name=\"kiekis\" style=\"width:50%;\" required>
        <input type=\"hidden\" name=\"prekesid\" value=\"".$url_id."\">
        <input type=\"submit\" name=\"submit\" value=\"Keisti\" />
        </form>" . 
                "</td>");
        
        $sql1 = $conn->prepare("SELECT * FROM turizymejima WHERE fk_preke = ?");
        $sql1->bind_param('i', $url_id);
        $sql1->execute();
        $result1 = $sql1->get_result();
        
        if (mysqli_affected_rows($conn) > 0) {
            $komentaroid = turizymejima::getFromDatabase($url_id);
            $komid = $komentaroid->fk_prekes_zymejimas;
            $komentaras = prekes_zymejimas::getFromDatabase($komid);
   echo "<td>" . $komentaras->pavadinimas . "</td>";
    } else { echo("<td></td>");}
    
    echo ("<td></td><td>". 
                "<form method=\"POST\" action=\"pridetiPazymeta.php\">
        <input type=\"hidden\" name=\"prekesid\" value=\"".$url_id."\">");
        $sql2 = "SELECT id, pavadinimas FROM prekes_zymejimas";
        $result2 = $conn->query($sql2);
         if ($result2->num_rows > 0) {
        $select2 = '<select name="select3">';
        while ($rs2 = mysqli_fetch_array($result2)) {
            $select2 .= '<option value="' . $rs2['id'] . '">' . $rs2['pavadinimas'] . '</option>';
        }
    }
    $select2 .= '</select>';
    echo $select2;
    
       echo(" <input type=\"submit\" name=\"submit\" value=\"Pažymėti prekę\" />
        </form>" . 
                "</td>");
       echo ("<td>". 
                " <form method=\"POST\" action=\"salintiPazymeta.php\">
        <input type=\"hidden\" name=\"prekesid\" value=\"".$url_id."\">
        <input type=\"submit\" name=\"submit\" value=\"X\" />
        </form>" . 
                "</td>");
        
    }
    echo ("</table>");
    echo ("<br></br>");
    echo("<table>");
    echo("<tr><td>"."<form>
        <input type=\"button\" value=\"Pridėti prekę į inventorių\" onclick=\"window.location.href='pridetiPreke.php'\" />
        </form></td>");
    echo("<td> <form method=\"POST\" action=\"sukurtiUzsakyma.php\">
        <input type=\"hidden\" name=\"userid\" value=\"".$userIDD."\">
        <input type=\"submit\" name=\"submit\" value=\"Užsakyti prekę\" />
        </form> </td>" );
    echo("<td> <form method=\"POST\" action=\"uzsakymusarasas.php\">
        <input type=\"submit\" name=\"submit\" value=\"Peržiūrėti užsakymų sąrašą\" />
        </form> </td>" );
    echo("<td> <form method=\"POST\" action=\"statistika.php\">
        <input type=\"submit\" name=\"submit\" value=\"Peržiūrėti statistiką\" />
        </form> </td></tr>" );
    
    
} else {
    echo "0 results";
}



    }
  
$conn->close();
?> 

</body>
</html>