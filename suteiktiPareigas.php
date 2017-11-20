

<form action ="suteiktiPareigasDarbuotojui.php" method="post">
    <?php echo ("<input type=\"hidden\" name=\"darbuotojas\" value=\"".$_GET['id']."\"></input>")?>
    Pavadinimas:<input type="text" name="pavadinimas"></input></br>
    Stažas:<input type="number" name="stazas" value="0" min="0"></input></br>
    Profesionalumo lygis:<input type="text" name="profesionalumo_lygis"></input></br>
    Sveikatos sutrikimai:<input type="text" name="sveikatos_sutrikimai"></input></br>
    <input type="submit" value="Patvirtinti"></input>
</form>