<?php
if (isset($_POST) && isset($_POST['darbuotojas'])) {
    include "grafikas.php";
    grafikas::addToDatabase($_POST['laikas_pirmad'], $_POST['laikas_antrad'], $_POST['laikas_treciad'], $_POST['laikas_ketvirtad'], $_POST['laikas_penktad'], $_POST['laikas_sestad'], $_POST['laikas_sekmad'], $_POST['darbuotojas']);
    header("Location: grafikasView.php?id=" . $_POST['darbuotojas']);
}
?>
<form action="grafikasCreate.php" method="post">
    <?php echo "<input type=\"hidden\" name=\"darbuotojas\" value=\"" . $_GET['darbuotojas'] . "\"></input>"; ?>
    Laikas pirmadieniais:<input name="laikas_pirmad"></input></br>
    Laikas antradieniais:<input name="laikas_antrad"></input></br>
    Laikas trečiadieniais:<input name="laikas_treciad"></input></br>
    Laikas ketvirtadieniais:<input name="laikas_ketvirtad"></input></br>
    Laikas penktadieniais:<input name="laikas_penktad"></input></br>
    Laikas šeštadieniais:<input name="laikas_sestad"></input></br>
    Laikas sekmadieniais:<input name="laikas_sekmad"></input></br>
    <input type="submit" value="Patvirtinti"></input>
</form>