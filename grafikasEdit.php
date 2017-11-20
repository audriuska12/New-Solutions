<?php
if (isset($_POST) && isset($_POST['darbuotojas'])) {
    include "darbuotojas.php";
    $grafikas = darbuotojas::getFromDatabase($_POST['darbuotojas'])->getGrafikas();
    $grafikas->update($_POST['laikas_pirmad'], $_POST['laikas_antrad'], $_POST['laikas_treciad'], $_POST['laikas_ketvirtad'], $_POST['laikas_penktad'], $_POST['laikas_sestad'], $_POST['laikas_sekmad'], $_POST['darbuotojas']);
    header("Location: grafikasView.php?id=" . $_POST['darbuotojas']);
}
?>
<form action="grafikasEdit.php" method="post">
    <?php
    include "darbuotojas.php";
    $grafikas = darbuotojas::getFromDatabase($_GET['darbuotojas'])->getGrafikas();
    echo "<input type=\"hidden\" name=\"darbuotojas\" value=\"" . $_GET['darbuotojas'] . "\"></input>";
    echo("Laikas pirmadieniais:<input name=\"laikas_pirmad\" value=" . $grafikas->laikas_pirmad . "></input></br>");
    echo("Laikas antradieniais:<input name=\"laikas_antrad\" value=" . $grafikas->laikas_antrad . "></input></br>");
    echo("Laikas treciadieniais:<input name=\"laikas_treciad\" value=" . $grafikas->laikas_treciad . "></input></br>");
    echo("Laikas ketvirtadieniais:<input name=\"laikas_ketvirtad\" value=" . $grafikas->laikas_ketvirtad . "></input></br>");
    echo("Laikas penktadieniais:<input name=\"laikas_penktad\" value=" . $grafikas->laikas_penktad . "></input></br>");
    echo("Laikas sestadieniais:<input name=\"laikas_sestad\" value=" . $grafikas->laikas_sestad . "></input></br>");
    echo("Laikas sekmadieniais:<input name=\"laikas_sekmad\" value=" . $grafikas->laikas_sekmad . "></input></br>");
    ?>
    <input type="submit" value="Patvirtinti"></input>
</form>