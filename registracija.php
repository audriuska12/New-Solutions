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
            Prisijungimo vardas:<input name="prisjungimo_vardas" type="decimal"></input></br>
            slaptazodis:<input name="slaptazodis" type="decimal"></input></br>
            Atpažinimo klausimas:<input name="atpazinimo_klausimas" type="decimal"></input></br>
            Atpažinimo atsakymas:<input name="atpazinimo_atsakymas" type="decimal"></input></br>
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
            <button type="submit" >Prisijungti</button>
            Darbuotojo rūšis:<select name="rusis">
            <?php
            include "vartotojo_rusis.php";
            include "prisijungimo_duomenys";
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
            $prisijungimo_vardas = "";
            $slaptazodis = "";
            $atpazinimo_klausimas = "";
            $atpazinimo_atsakymas = "";
            if(isset($_POST["vardas"]) && 
                    isset($_POST["pavarde"]) && 
                    isset($_POST["tel_nr"]) && 
                    isset($_POST["el_pastas"]) && 
                    isset($_POST["adresas"]) && 
                    isset($_POST["alga"]) && 
                    isset($_POST["finansai"]) &&
                    isset($_POST["prisijungimo_vardas"]) &&
                    isset($_POST["prisijungimo_vardas"]) &&
                    isset($_POST["slaptazodis"]) &&
                    isset($_POST["atpazinimo_klausimas"]) &&
                    isset($_POST["atpazinimo_atsakymas"]) 
                    )
                {
                $phpVardas = $_POST["vardas"];
                $phpPavarde = $_POST["pavarde"];
                $phpTel_nr = $_POST["tel_nr"];
                $phpEl_pastas = $_POST["el_pastas"];
                $phpAdresas = $_POST["adresas"];
                $phpAlga = $_POST["alga"];
                $phpFinansai = $_POST["finansai"];
                $prisijungimo_vardas = $_POST["finansai"];
                $slaptazodis = $_POST["finansai"];
                $atpazinimo_klausimas = $_POST["finansai"];
                $atpazinimo_atsakymas = $_POST["finansai"];
            }
            $dbc = mysqli_connect(get_cfg_var('dbhost'), get_cfg_var('dbuser'), get_cfg_var('dbpw'), get_cfg_var('dbname'));           
            $sql1 = $dbc->prepare("SELECT COUNT(*) as total
                           FROM prisijungimo_duomenys
                               WHERE `prisijungimo_vardas`='{$prisijungimo_vardas}'");
            $sql1->execute();
            $result = $sql1->get_result();
            //var_dump($dbc); die;
            $toksYra = false;
              while ($row = $result->fetch_assoc()) {
                if ($row["total"] !== 0) {
                    $toksYra = true;
                }
            if($toksYra){
                echo "Toksvartotojo vardas jau yra";
            }
            if(!$toksYra){
                $date1 = date();
                $sql = $dbc->prepare("INSERT INTO darbuotojas (vardas, pavarde,el_pastas, adresas, dirba_nuo, atleistas, alga, fk_darbuotoju_finansai, fk_vartotojo_rusis,)
                                                        VALUES ($vardas, $pavarde, $el_pastas, $adresas, $date1,'0', $alga, '1','1')");
                // $sql->bind_param('s', $vartotojo_vardas);
                //var_dump($sql);
                $sql->execute();
                var_dump($sql);
                if (mysqli_affected_rows($dbc) > 0) {
                    echo "registracija yra sekminga";
                }
            }
            echo $toksyra;
        }
            ?>
            </select></br>
            <input type="submit" value="Registruoti"></input>
        </form>
        
    </body>
</html>