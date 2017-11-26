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
        include "testfile.php";
        $userID = 10;
// Create connection
        $conn = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT kiekis, ar_atlikta, numatoma_uzsakymo_pabaiga, uzsakymo_pabaigos_data, uzsakymo_pabaigos_laikas, fk_preke FROM uzsakymo_busena";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<font size="5"' . " face='Arial'>" . "Užsakymų sąrašas:" . '</font>';
            echo("<table>");
            echo("<tr> <th>Pavadinimas </th> <th>Kiekis</th> <th> Būsena </th> <th>Numatoma pabaiga</th><th>Pabaigos data</th> <th>Pabaigos laikas</th><th></th>");
            echo("<tr>");
            while ($row = $result->fetch_assoc()) {
                $url_id = $row['fk_preke'];
                $komentaroid = preke::getFromDatabase($url_id);
                echo ("<td>" . $komentaroid->pavadinimas . "</td>" . "</td><td>" . $row["kiekis"] . "</td><td>");
                if ($row["ar_atlikta"] == 0) {
                    echo(" Neatliktas ");
                } else
                    echo("Atliktas");
                echo ("</td><td>" . $row["numatoma_uzsakymo_pabaiga"] . "</td><td>" . $row["uzsakymo_pabaigos_data"] . "</td><td>" . $row["uzsakymo_pabaigos_laikas"] . "</td>" );
                if ($row["ar_atlikta"] == 0) {
                    echo("<td>" . " <form method=\"POST\" action=\"pridetilaikus.php\">
        <input type=\"hidden\" name=\"prekesid\" value=\"".$url_id."\">
        <input type=\"submit\" name=\"submit\" value=\"Pakeisti būsena\" />
        </form>"."</td>");
                }
                echo("</tr>");
            }
        } else {
            echo "0 results";
        }echo("<table>");
        echo("</form>" . "<br><br>"."<form method=\"POST\" action=\"inventorius.php\">".
        "<input type=\"submit\" name=\"submit\" value=\"Atgal į inventorių\" />"
        ."</td></tr></table>" );





        $conn->close();
        ?> 

    </body>
</html>