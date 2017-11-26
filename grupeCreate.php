<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "darbuotojas.php";
if (!isset($_SESSION['userID'])) {
    header("Location:accessDenied.php");
} else {
    if (isset($_POST['pavadinimas'])) {
        grupe::addToDatabase($_POST['pavadinimas'], date("Y-m-d"), $_SESSION['userID'], $_POST['matomumas']);
        header("Location: grupesView.php");
    }
}
?>

<form action="grupeCreate.php" method="post">
    Pavadinimas:<input type="text" name="pavadinimas"></input></br>
    Matomumas:<select name="matomumas">
        <option value="0">Privati</option>
        <option value="1">Vieša</option>
    </select></br>
    <input type="submit" value="Sukurti"></input>
</form>
