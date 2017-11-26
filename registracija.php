<html>
    <head><title>Darbuotojo registracija</title></head>
    <body>
        Darbuotojo registracija:
        <form action ="registracija.php" method="post">
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
            
            
            $phpVardas = "";
            $phpPavarde = "";
            $phpTel_nr = "";
            $phpEl_pastas = "";
            $phpAdresas = "";
            $phpAlga = "";
            $phpFinansai = "";
            if(isset($_POST["vardas"]) && 
                    isset($_POST["pavarde"]) && 
                    isset($_POST["tel_nr"]) && 
                    isset($_POST["el_pastas"]) && 
                    isset($_POST["adresas"]) && 
                    isset($_POST["alga"]) && 
                    isset($_POST["finansai"]))
                {
                $phpVardas = $_POST["vardas"];
                $phpPavarde = $_POST["pavarde"];
                $phpTel_nr = $_POST["tel_nr"];
                $phpEl_pastas = $_POST["el_pastas"];
                $phpAdresas = $_POST["adresas"];
                $phpAlga = $_POST["alga"];
                $phpFinansai = $_POST["finansai"];
            }
            
            ?>
            </select></br>
            <input type="submit" value="Registruoti"></input>
        </form>
        
    </body>
</html>