<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "darbuotojas.php";
if (!isset($_SESSION['userID'])) {
    header("Location:accessDenied.php");
}
$user = darbuotojas::getFromDatabase($_SESSION['userID']);
$rusis = $user->getRusis()->pavadinimas;
if (!($rusis == "Parduotuvės vadovas" || $rusis == "Parduotuvių tinklo vadovas")) {
    header("Location:accessDenied.php");
}
if (isset($_POST['darbuotojas'])) {
    $darbuotojasid = $_POST['darbuotojas'];
} else {
    $darbuotojasid = $_GET['darbuotojas'];
}
$darbuotojas=darbuotojas::getFromDatabase($darbuotojasid);
if (!($user->arVirsesnis($darbuotojas) || ($user->id == $darbuotojas->id))) {
    header("Location:accessDenied.php");
} else {
    if (isset($_POST) && isset($_POST['darbuotojas'])) {
        include_once "grafikas.php";
        grafikas::addToDatabase($_POST['laikas_pirmad'], $_POST['laikas_antrad'], $_POST['laikas_treciad'], $_POST['laikas_ketvirtad'], $_POST['laikas_penktad'], $_POST['laikas_sestad'], $_POST['laikas_sekmad'], $_POST['darbuotojas']);
        header("Location: grafikasView.php?id=" . $_POST['darbuotojas']);
    }
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