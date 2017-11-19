<html>
    <head>
        <title>Kontaktai</title>
    </head>
    <body>
        <?php
        include "darbuotojas.php";
        $kontaktai = darbuotojas::getKontaktai($_GET['id']);
        echo ("<table>");
        echo("<tr><th>Telefono numeris:</th><td>" . $kontaktai['tel_nr'] . "</td></tr>");
        echo("<tr><th>El. paštas:</th><td>" . $kontaktai['el_pastas'] . "</td></tr>");
        echo("<tr><th>Adresas:</th><td>" . $kontaktai['adresas'] . "</td></tr>");
        echo ("</table>");
        ?>
    </body>
</html>