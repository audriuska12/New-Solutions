<?php
if(isset($_POST['grupe'])){
    include "grupe.php";
    $grupe = grupe::getFromDatabase($_POST['grupe']);
    $grupe->addDarbuotojas($_POST['id']);
    header("Location: grupesNariai.php?id=".$_POST['grupe']);
}
?>
<form action="grupePridetiNari.php" method="post">
    <?php echo ("<input type=\"hidden\" name=\"grupe\" value=\"".$_GET['id']."\"></input>");?>
    Pasirinkti naują narį:<select name="id">
        <?php
            include "grupe.php";
            $grupe = grupe::getFromDatabase($_GET['id']);
            $neNariai= $grupe->getNeNariai();
            $count = count($neNariai);
            for($i = 0; $i<$count; $i++){
                echo("<option value=\"".$neNariai[$i]->id."\">".$neNariai[$i]->pavarde." ".$neNariai[$i]->vardas."</option>");
            }
        ?>
    </select></br>
    <input type="submit" value="Patvirtinti"></input>
</form>


