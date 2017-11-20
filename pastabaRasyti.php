<?php
    if(isset($_POST['rec'])){
        include "pastaba.php";
    pastaba::addToDatabase($_POST['viesa'], $_POST['tekstas'], $_POST['wr'], $_POST['rec']);
    header("Location: pastabosViesos.php?id=".$_POST['rec']);
    }
?>
<form action="pastabaRasyti.php" method="post">
    <?php
    echo("<input type=\"hidden\" name=\"rec\" value=\"".$_GET['id']."\"></input>");
    echo("<input type=\"hidden\" name=\"wr\" value=\"".$_GET['wr']."\"></input>");
    echo("");
    ?>
    <input type="text" name="tekstas"></input>
    <select name="viesa">
        <option value="0">Privati</option>
        <option value="1">Vieša</option>
    </select></br>
    <input type="submit" value="Įrašyti"></input>
</form>