<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="tables.css">
        <title>Kontaktai</title>
    </head>
    <body>
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
        $grafikas=darbuotojas::getFromDatabase($_POST['darbuotojas'])->getGrafikas();
        $grafikas->update($_POST['laikas_pirmad'], $_POST['laikas_antrad'], $_POST['laikas_treciad'], $_POST['laikas_ketvirtad'], $_POST['laikas_penktad'], $_POST['laikas_sestad'], $_POST['laikas_sekmad'], $_POST['darbuotojas']);
        header("Location: grafikasView.php?id=" . $_POST['darbuotojas']);
    }
}
?>
<form action="grafikasEdit.php" method="post">
    <table>
    <?php
    include_once "darbuotojas.php";
    $grafikas = darbuotojas::getFromDatabase($_GET['darbuotojas'])->getGrafikas();
    echo ("<input type=\"hidden\" name=\"darbuotojas\" value=\"" . $_GET['darbuotojas'] . "\"></input>");
    echo("<tr><th>Laikas pirmadieniais:</th><td><input name=\"laikas_pirmad\" value=" . $grafikas->laikas_pirmad . "></input></td></tr>");
    echo("<tr><th>Laikas antradieniais:</th><td><input name=\"laikas_antrad\" value=" . $grafikas->laikas_antrad . "></input></td></tr>");
    echo("<tr><th>Laikas treciadieniais:</th><td><input name=\"laikas_treciad\" value=" . $grafikas->laikas_treciad . "></input></td></tr>");
    echo("<tr><th>Laikas ketvirtadieniais:</th><td><input name=\"laikas_ketvirtad\" value=" . $grafikas->laikas_ketvirtad . "></input></td></tr>");
    echo("<tr><th>Laikas penktadieniais:</th><td><input name=\"laikas_penktad\" value=" . $grafikas->laikas_penktad . "></input></td></tr>");
    echo("<tr><th>Laikas sestadieniais:</th><td><input name=\"laikas_sestad\" value=" . $grafikas->laikas_sestad . "></input></td></tr>");
    echo("<tr><th>Laikas sekmadieniais:</th><td><input name=\"laikas_sekmad\" value=" . $grafikas->laikas_sekmad . "></input></td></tr>");
    ?>
    </table>
    <input type="submit" value="Patvirtinti"></input>
</form>
    </body>
</html>