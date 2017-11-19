<html>
    <head><title>Darbuotojo registracija</title></head>
    <body>
        Darbuotojo registracija:
        <form action ="registerprocess.php" method="post">
            Vardas:<input name="vardas" type="text"></input></br>
            Pavardė:<input name="pavarde" type="text"></input></br>
            Telefono nr.:<input name="tel_nr" type="text"></input></br>
            El. paštas:<input name="el_pastas" type="email"></input></br>
            Adresas:<input name="adresas" type=text"></input></br>
            Alga:<input name="alga" type="decimal"></input></br>
            Finansų apskaita:<select name="finansai">
            <?php
            include "darbuotoju_finansai.php";
            $finansai= darbuotoju_finansai::getDarbuotojuFinansai();
            $countfin = count($finansai);
            for($i=0; $i<$countfin; $i++){
                echo ("<option value=\"".$finansai[$i]->id."\">".$finansai[$i]->id."");
            }
            ?>
            </select></br>
            Darbuotojo rūšis:<select name="rusis">
            <?php
            include "vartotojo_rusis.php";
            $rusys=vartotojo_rusis::getVartotojuRusys();
            $countrus = count($rusys);
            for($i=0; $i<$countrus; $i++){
                echo ("<option value=\"".$rusys[$i]->id."\">".$rusys[$i]->pavadinimas."");
            }
            ?>
            </select></br>
            <input type="submit" value="Registruoti"></input>
        </form>
    <body>
</html>