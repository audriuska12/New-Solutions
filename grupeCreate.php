<?php
    if(!isset($_POST['administratorius'])){
        
    } else{
        include "grupe.php";
        grupe::addToDatabase($_POST['pavadinimas'], date("Y-m-d"), $_POST['administratorius'], $_POST['matomumas']);
        header("Location: grupesAdministruojamos.php?id=".$_POST['administratorius']);
    }
?>

<form action="grupeCreate.php" method="post">
    <?php echo("<input type=\"hidden\" name=\"administratorius\" value=\"".$_GET['id']."\"></input>");?>
    Pavadinimas:<input type="text" name="pavadinimas"></input></br>
    Matomumas:<select name="matomumas">
        <option value="0">Privati</option>
        <option value="1">Vieša</option>
    </select></br>
    <input type="submit" value="Sukurti"></input>
</form>
