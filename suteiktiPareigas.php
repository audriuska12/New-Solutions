

<form action ="suteiktiPareigasDarbuotojui.php" method="post">
    <?php echo ("<input type=\"hidden\" name=\"darbuotojas\" value=\"".$_GET['id']."\"></input>")?>
    Parinkti esamas:</br>
    <select name="pareigos">
        <option value="0"></option>
        <?php
            include "darbuotojas.php";
            $darbuotojas = darbuotojas::getFromDatabase($_GET['id']);
            $pareigos = $darbuotojas->getNeturimosPareigos();
            $count = count($pareigos);
            for($i=0; $i<$count; $i++){
                echo("<option value=\"".$pareigos[$i]->id."\">".$pareigos[$i]->pavadinimas."</option>");
            }
        ?>
    </select></br>
    Kurti naujas:</br>
    Pavadinimas:<input type="text" name="pavadinimas"></input></br>
    Stažas:<input type="number" name="stazas" value="0" min="0"></input></br>
    Profesionalumo lygis:<input type="text" name="profesionalumo_lygis"></input></br>
    Sveikatos sutrikimai:<input type="text" name="sveikatos_sutrikimai"></input></br>
    <input type="submit" value="Patvirtinti"></input>
</form>