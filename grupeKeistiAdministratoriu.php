<?php
if(isset($_POST['administratorius'])){
    include "grupe.php";
    $grupe = grupe::getFromDatabase($_POST['id']);
    $senas = $grupe->administratorius;
    $grupe->changeAdministratorius($_POST['administratorius']);
    header("Location: grupesAdministruojamos.php?id=".$senas);
}
?>
<form action="keistiAdministratoriu.php" method="post">
    <?php echo ("<input type=\"hidden\" name=\"id\" value=\"".$_GET['id']."\"></input>");?>
    Pasirinkti naują administratorių:<select name="administratorius">
        <?php
            include "grupe.php";
            $grupe = grupe::getFromDatabase($_GET['id']);
            $nariai= $grupe->getDarbuotojaiBeAdministratoriaus();
            $count = count($nariai);
            for($i = 0; $i<$count; $i++){
                echo("<option value=\"".$nariai[$i]->id."\">".$nariai[$i]->pavarde." ".$nariai[$i]->vardas."</option>");
            }
        ?>
    </select></br>
    <input type="submit" value="Patvirtinti"></input>
</form>


